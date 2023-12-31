@extends('layouts.include-app')

@section('content-include')

    <x-back-previous-url />
    <a class="closeButton"></a>
    <div id="example" class="k-content">

        <div id="grid"></div>

        <div class="details" id="table" data-tb-name="signal"></div>


    @section('js-include')
        <script>
         
            let parent_table_name = "{{ __('content.signal') }}"
        </script>
        <script src='{{ asset('assets-include/js/result-relations.js') }}'></script>


        <script>
            var wnd;
            $(document).ready(function() {
                var json = '<?php echo $data; ?>';
                var data = $.parseJSON(json.replace(/\n/g, "\\n"));
                dataSource = new kendo.data.DataSource({
                    type: 'odata',
                    data: data,
                    batch: true,
                    pageSize: 20,
                    schema: {
                        model: {
                            id: "id",
                            fields: {
                                id: {
                                    editable: false,
                                    nullable: false,
                                    type: 'number'
                                },
                                created_at: {
                                    type: 'date'
                                },
                                subunit_date: {
                                    type: 'date'
                                },
                                check_date: {
                                    type: 'date'
                                },
                                end_date: {
                                    type: 'date'
                                },
                                check_line: {
                                    type: 'number'
                                },
                                keep_count: {
                                    type: 'number'
                                },
                                reg_num: {
                                    type: 'number'
                                },
                                check_date_count: {
                                    type: 'number'
                                },
                                count_days: {
                                    type: 'number'
                                },
                                man_count: {
                                    type: 'number'
                                }
                            }
                        }
                    }
                });

                var grid = $("#grid").kendoGrid({
                    dataSource: dataSource,
                    pageable: true,
                    resizable: true,
                    navigatable: true,
                    sortable: true,
                    height: 430,
                    scrollable: true,
                    dataBound: dataBound,
                    toolbar: [{
                        name: 'resetFilter',
                        text: `{{ __('content.clean_all') }}`
                    }],
                    filterable: {
                        extra: false,
                        operators: {
                            string: {
                                startswith: `{{ __('content.start') }}`,
                                eq: `{{ __('content.equal') }}`,
                                neq: `{{ __('content.not_equal') }}`,
                                contains: `{{ __('content.contains') }}`
                            },
                            date: {
                                eq: `{{ __('content.equal') }}`,
                                neq: `{{ __('content.not_equal') }}`,
                                gt: `{{ __('content.more') }}`,
                                gte: `{{ __('content.more_equal') }}`,
                                lt: `{{ __('content.less') }}`,
                                lte: `{{ __('content.less_equal') }}`

                            },
                            number: {
                                eq: `{{ __('content.equal') }}`,
                                neq: `{{ __('content.not_equal') }}`,
                                gt: `{{ __('content.more') }}`,
                                gte: `{{ __('content.more_equal') }}`,
                                lt: `{{ __('content.less') }}`,
                                lte: `{{ __('content.less_equal') }}`

                            }
                        },
                        messages: {
                            info: `{{ __('content.search_as') }}`,
                            filter: `{{ __('content.seek') }}`,
                            clear: `{{ __('content.clean') }}`,
                            and: `{{ __('content.and') }}`,
                            or: `{{ __('content.or') }}`
                        }
                    },
                    columns: [{
                            command: {
                                name: "aJoin",
                                text: "<i class='bi bi-eye' style='width: 30px;height: 30px;font-size: 27px;' title='{{ __('content.view_ties') }}' ></i>",
                                // click: showDetailsSignal
                                click: showDetailsRelation

                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('signal-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editSignal
                            },
                            width: "90px"
                        },
                        <?php } ?> {
                            field: "id",
                            width: "100px",
                            title: "Id",
                            filterable: {
                                extra: false,
                                operators: {
                                    number: {
                                        eq: `{{ __('content.equal') }}`,
                                        neq: `{{ __('content.not_equal') }}`,
                                    }
                                },
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "reg_num",
                            width: "290px",
                            title: `{{ __('content.reg_number_signal') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "content",
                            width: "360px",
                            title: `{{ __('content.contents_information_signal') }}`
                        },
                        {
                            field: "check_line",
                            width: "310px",
                            title: `{{ __('content.line_which_verified') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "check_status",
                            width: "335px",
                            title: `{{ __('content.check_status_charter') }}`
                        },
                        {
                            field: "signal_qualification",
                            width: "380px",
                            title: `{{ __('content.qualifications_signaling') }}`
                        },
                        {
                            field: "resource",
                            width: "220px",
                            title: `{{ __('content.source_category') }}`
                        },
                        {
                            field: "check_unit",
                            width: "280px",
                            title: `{{ __('content.checks_signal') }}`
                        },
                        {
                            field: "check_agency",
                            width: "335px",
                            title: `{{ __('content.department_checking') }}`
                        },
                        {
                            field: "check_subunit",
                            width: "360px",
                            title: `{{ __('content.unit_testing') }}`
                        },
                        {
                            field: "checking_worker",
                            width: "310px",
                            title: `{{ __('content.name_checking_signal') }}`
                        },
                        {
                            field: "checking_worker_post",
                            width: "270px",
                            title: `{{ __('content.worker_post') }}`
                        },
                        {
                            field: "subunit_date",
                            width: "400px",
                            title: `{{ __('content.date_registration_division') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "check_date",
                            width: "395px",
                            title: `{{ __('content.check_date') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "check_date_id",
                            width: "350px",
                            title: `{{ __('content.check_previously') }}`
                        },
                        {
                            field: "check_date_count",
                            width: "150px",
                            title: `{{ __('content.count') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "end_date",
                            width: "400px",
                            title: `{{ __('content.date_actual_word') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "count_days",
                            width: "100px",
                            title: `{{ __('content.amount_overdue') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "resource_id",
                            width: "310px",
                            title: `{{ __('content.useful_capabilities') }}`
                        },
                        {
                            field: "signal_result",
                            width: "215px",
                            title: `{{ __('content.signal_results') }}`
                        },
                        {
                            field: "taken_measure",
                            width: "175px",
                            title: `{{ __('content.measures_taken') }}`
                        },
                        {
                            field: "opened_dou",
                            width: "380px",
                            title: `{{ __('content.according_result_dow') }}`
                        },
                        {
                            field: "opened_agency",
                            width: "340px",
                            title: `{{ __('content.brought_signal') }}`
                        },
                        {
                            field: "opened_unit",
                            width: "295px",
                            title: `{{ __('content.department_brought') }}`
                        },
                        {
                            field: "opened_subunit",
                            width: "370px",
                            title: `{{ __('content.unit_brought') }}`
                        },
                        {
                            field: "worker",
                            width: "310px",
                            title: `{{ __('content.name_operatives') }}`
                        },
                        {
                            field: "worker_post",
                            width: "270px",
                            title: `{{ __('content.worker_post') }}`
                        },
                        {
                            field: "keep_count",
                            width: "200px",
                            title: `{{ __('content.keep_signal') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "man_count",
                            width: "80px",
                            title: `{{ __('content.face') }}`,
                            filterable: {
                                extra: false,
                                operators: {
                                    number: {
                                        eq: `{{ __('content.equal') }}`,
                                        neq: `{{ __('content.not_equal') }}`,
                                    }
                                },
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        // {
                        //     field: "created_at",
                        //     width: "115px",
                        //     title: "-->{{ __('content.created_at') }}",
                        //     format: "{0:dd-MM-yyyy}",
                        //     filterable: {
                        //         ui: setDatePicker,
                        //         extra: true
                        //     }
                        // },
                        // {
                        //     command: {
                        //         name: "aWord",
                        //         text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                        //         click: openWord
                        //     },
                        //     width: "90px"
                        // },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('signal-delete') ) { ?> {
                            command: {
                                name: "aDelete",
                                text: "<i class='bi bi-trash3' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.delete') }}' ></i>",
                                click: tableDelete<?php echo $_SESSION['counter']; ?>
                            },
                            width: "90px"
                        }
                        <?php } ?>
                    ],
                    selectable: true
                }).data("kendoGrid");

                wnd = $(".details")
                    .kendoWindow({
                        title: "Связи",
                        modal: false,
                        visible: false,
                        resizable: true,
                        actions: ["Minimize", "Maximize", "Close"],
                        width: 600,
                        height: 450

                    }).data("kendoWindow");

                $('#addNewSignal').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/${lang}/add/signal/` + tb_name,
                        dataType: 'html',
                        success: function(data) {
                            removeItem();
                            addItem(data, title);
                        }
                    });
                });

            });

            function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
                e.preventDefault();

                let path_name = window.location.pathname
                path_name = path_name.split('/').reverse()[0]

                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                var confDel = confirm(`{{ __('content.delete_entry') }}`);
                if (confDel) {
                    $.ajax({
                        url: `/search-delete/${path_name}/${dataItem.id}`,
                        type: 'delete',
                        data: {
                            'id': dataItem.id
                        },
                        success: function(data) {
                            $("#grid").data("kendoGrid").dataSource.remove(dataItem);
                        },
                        faild: function(data) {
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }
            }

            // function showDetailsSignal(e) {
            //     e.preventDefault();

            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     $('.k-window-title').html(`{{ __('content.ties_signal') }}`+dataItem.id);
            //     wnd.refresh({ url: `/${lang}/open/signalJoins/`+dataItem.id });
            //     wnd.center().open();
            // }

            // function openWord(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     window.open(`/${lang}/word/signal_with_joins/` + dataItem.id, '_blank');
            // }

            function editSignal(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                location.href = `/${lang}/signal/${dataItem.id}/edit`

                // $.ajax({
                //     url: `/${lang}/add/signal/` + dataItem.bibliography_id + '/' + dataItem.id,
                //     dataType: 'html',
                //     success: function(data) {
                //         if (typeof bId == 'undefined') {
                //             bId = dataItem.bibliography_id;
                //         }
                //         addItem(data, `{{ __('content.signal') }}`);
                //     },
                //     faild: function(data) {
                //         alert(`{{ __('content.err') }}`);
                //     }
                // });
            }


            function setDateTimeP(element) {
                element.kendoDateTimePicker({
                    format: "dd-MM-yyyy HH:mm",
                    timeFormat: "HH:mm"
                });
            }

            function setDatePicker(element) {
                element.kendoDatePicker({
                    format: "dd-MM-yyyy"
                })
            }
        </script>
    </div>
@endsection
@endsection
