@extends('layouts.auth-app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/template-search/signal-report.css') }}">
@endsection

@section('content')

    <x-breadcrumbs :title="__('content.report_search')"/>

    <!-- End Page Title -->

    <div id="report-errors" class="d-none alert alert-danger">
    </div>
    <div id="report-messages" class="d-none alert alert-success">
    </div>


    <!-- Generate report part start -->
    <section class="section">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center my-3"></div>
                    <form id="report_form" method="POST" action="{{ route('report.generate') }}">
                        @csrf
                        <div class="signal-report">
                            {{-- <label for="">{{ __('content.report_search') }}</label> --}}
                            <select name="reportType" class="month-select form-select mb-3">
                                @foreach (config('report.report_types') as $name)
                                    <option value="{{$name}}">{{__("report.$name")}}</option>
                                @endforeach
                            </select>
                            <div class="report-selects">
                                <select name="reportRange" class="month-select form-select" id="mySelect">
                                    @foreach (config('report.report_ranges') as $r_name)
                                        <option id="option_{{$r_name}}"
                                                value="{{$r_name}}">{{__("report.$r_name")}}</option>
                                    @endforeach
                                </select>
                                <select name="year" class="year-select form-select" id="select2"
                                        style="display: block"></select>
                            </div>

                        </div>
                        <div class="date_div">
                            <input type="date" name="startDate" id="otherInput" class="form-control"
                                   style="display: none; width:20%"/>
                            <pre id="line" style="display: none; margin-top:10px"> -- </pre>
                            <input type="date" name="endDate" id="otherInput2" class="form-control"
                                   style="display: none; width:20%"/>
                        </div>
                        <div class="export-button">
                            <button id="report-submit" type="submit"
                                    class="btn btn-primary report-button">{{ __('content.report_search') }}</button>
                        </div>
                    </form>
                </div>
                <div id="countries-list"></div>
            </div>
        </div>
    </section>
    <div>

        @endsection
        @section('js-scripts')
            <script src='{{ asset('assets/js/template-search/signal-report.js') }}'></script>
            <script>
                window.addEventListener("load", () => {
                    let block_errors = document.getElementById('report-errors')
                    let block_messages = document.getElementById('report-messages')
                    let submit_button = document.getElementById('report-submit')

                    document.querySelector('#report_form').addEventListener('submit', (e) => {
                        e.preventDefault();
                        let formData = new FormData(e.target);
                        submit_button.disabled = true;
                        submitReportForm(formData)
                        submit_button.disabled = false;
                    });

                    async function submitReportForm(formData) {
                        block_errors.classList.add('d-none');
                        block_messages.classList.add('d-none');
                        const response = await fetch("{{ route('report.generate') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        const {status} = response;

                        if (status === 200) {
                            const report_file_content = await response.blob();
                            downloadFile(report_file_content, response.headers.get('File_name'))
                        } else if (status === 422 || status === 400) {
                            const err = await response.json();
                            setErrors(err)
                        } else {
                            setErrors('Something went wrong !!')
                        }
                    }

                    function downloadFile(blob, filename) {
                        let a = document.createElement("a");
                        a.href = window.URL.createObjectURL(blob);
                        a.setAttribute("download", filename);
                        a.click();
                        block_messages.classList.remove('d-none');
                        block_messages.innerText = 'Report successfully downloaded';
                    }

                    function setErrors(err) {
                        let err_html = '';
                        if (typeof err === 'object') {
                            if ('errors' in err) {
                                for (const [key, values] of Object.entries(err['errors'])) {
                                    for (let e of values) {
                                        err_html += `<li>${e}</li>`;
                                    }
                                }
                            }
                        } else if (typeof err === 'string' && err) {
                            err_html = `<li>${err}</li>`
                        }

                        if (err_html) {
                            block_errors.classList.remove('d-none')
                            block_errors.innerHTML = `<ul>${err_html}</ul>`
                        }
                    }
                });
            </script>
@endsection

