<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

class ReportGenerateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'reportType' => ['required', 'string', Rule::in(config('report.report_types'))],
            'reportRange' => ['required', 'string', Rule::in(config('report.report_ranges'))],
            'year' => ['required', 'digits:4', 'integer', 'min:1900', 'max:' . (1 + (int)date('Y'))],
            'startDate' => ['required_if:reportRange,other', 'nullable', 'date', 'date_format:Y-m-d'],
            'endDate' => ['required_if:reportRange,other', 'nullable', 'date', 'date_format:Y-m-d', 'after_or_equal:startDate', 'before_or_equal:' . Carbon::now()->format('Y-m-d')],
        ];
    }

    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function (Validator $validator) {

                $range = getDateRange($this->reportRange, $this->year, $this->startDate, $this->endDate);
                extract($range);
                $total = 0;
                switch ($this->reportType) {
                    case 'opened':
                    case 'by_qualification':
                        $total = DB::table('signal')
                            ->where('subunit_date', '<=', $to)
                            ->where('subunit_date', '>=', $from)
                            ->count();
                        break;
                    case 'active':
                    case 'by_signal':
                        $total = DB::table('signal')
                            ->where('end_date', '<=', $to)
                            ->where('subunit_date', '>=', $from)
                            ->count();
                        break;
                    case 'suspended':
                        $total = DB::table('signal')
                            ->where('end_date', '<=', $to)
                            ->where('end_date', '>=', $from)
                            ->count();
                        break;
                }

                if ($total === 0) {
                    $validator->errors()->add('report', __('validation.custom.report_data_not_found'));
                }
            });
        }

    }

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }


}
