<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportGenerateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reportType' => ['required', 'string', Rule::in(config('report.report_types'))],
            'reportRange' => ['required', 'string', Rule::in(config('report.report_ranges'))],
            'year' => ['required', 'digits:4', 'integer', 'min:1900', 'max:' . (1 + (int)date('Y'))],
            'startDate' => ['required_if:reportRange,other', 'nullable', 'date', 'date_format:Y-m-d'],
            'endDate' => ['required_if:reportRange,other', 'nullable', 'date', 'date_format:Y-m-d', 'after_or_equal:startDate', 'before_or_equal:' . Carbon::now()->format('Y-m-d')],
        ];
    }

}
