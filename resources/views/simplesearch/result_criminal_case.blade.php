@extends('layouts.include-app')

@section('content-include')

    @if(!empty($checkUrl) && $checkUrl !== 'advancedsearch')
        <x-back-previous-url />
    @endif
    <a class="closeButton"></a>
    <div id="example" class="k-content">
        <div style="width: 70%; text-align: left">
            <?php
            $keyArray = ['number', 'opened_date', 'artical', 'opened_unit_idName', 'opened_unit', 'opened_agency', 'opened_agency_idName', 'subunit', 'subunit_idName', 'worker', 'worker_post', 'worker_post_idName', 'character', 'opened_dou', 'content'];
            $params = json_decode(session()->get('search_params'), true);
            foreach ($params as $key => $value) {
                if (gettype($value) == 'array' && in_array($key, $keyArray)) {
                    foreach ($value as $val) {
                        if ($val != '') {
                            echo $val . '; ';
                        }
                    }
                } elseif ($value != '' && gettype($value) == 'string' && in_array($key, $keyArray)) {
                    echo $value, '; ';
                }
            }
            ?>
        </div>

        <div style="text-align: right">
            <a class="k-button k-button-icontext k-grid-resetFilter"
                href="{{ route('simple_search_criminal_case', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
            <a class="k-button k-button-icontext k-grid-resetFilter"
                href="{{ route('simple_search_criminal_case', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
        </div>

        <div id="grid"></div>

        <div class="details" id="table" data-tb-name="criminal_case"></div>

    @section('js-include')
        <script>
       
            let parent_table_name = "{{ __('content.criminal_case') }}"
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
                                opened_date: {
                                    type: 'date'
                                },
                                created_at: {
                                    type: 'date'
                                },
                                number: {
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
                                // click: showDetailsCriminalCase
                                click: showDetailsRelation

                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('criminal_case-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editCriminalCase
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
                            field: "number",
                            width: "135px",
                            title: `{{ __('content.number_case') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "opened_date",
                            width: "350px",
                            title: `{{ __('content.criminal_proceedings_date') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "artical",
                            width: "390px",
                            title: `{{ __('content.criminal_code') }}`
                        },
                        {
                            field: "opened_agency",
                            width: "353px",
                            title: `{{ __('content.materials_management') }}`
                        },
                        {
                            field: "opened_unit",
                            width: "310px",
                            title: `{{ __('content.head_department') }}`
                        },
                        {
                            field: "subunit",
                            width: "385px",
                            title: `{{ __('content.instituted_units') }}`
                        },
                        {
                            field: "worker",
                            width: "285px",
                            title: `{{ __('content.name_operatives') }}`
                        },
                        {
                            field: "worker_post",
                            width: "270px",
                            title: `{{ __('content.worker_post') }}`
                        },
                        {
                            field: "character",
                            width: "300px",
                            title: `{{ __('content.nature_materials_paint') }}`
                        },
                        {
                            field: "opened_dou",
                            width: "210px",
                            title: `{{ __('content.initiated_dow') }}`
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
                        //     title: `-->{{ __('content.created_at') }} `,
                        //     format: "{0:dd-MM-yyyy}",
                        //     -- >
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
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('criminal_case-delete')) { ?> {
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
                        //                    content:`/${lang}/open/weaponJoins/`
                    }).data("kendoWindow");

                $('#addNewCriminalCase').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/${lang}/add/criminal_case/` + tb_name,
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
                        // data: {
                        //     'id': dataItem.id
                        // },
                        success: function(data) {
                            $("#grid").data("kendoGrid").dataSource.remove(dataItem);
                        },
                        faild: function(data) {
                            alert(`{{ __('content.err') }}`);
                        }
                    });
                }
            }

            // function showDetailsCriminalCase(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     $('.k-window-title').html(`{{ __('content.ties_criminal_case') }}` + dataItem.id);
            //     wnd.refresh({
            //         url: `/${lang}/open/criminalCaseJoins/` + dataItem.id
            //     });
            //     wnd.center().open();
            // }

            // function openWord(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     window.open(`/${lang}/word/criminal_case/`+dataItem.id, '_blank' );
            // }

            function editCriminalCase(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                location.href = `/${lang}/criminal_case/${dataItem.id}/edit`

                // $.ajax({
                //     url: `/${lang}/add/criminal_case/` + dataItem.bibliography_id + '/' + dataItem.id,
                //     dataType: 'html',
                //     success: function(data) {
                //         if (typeof bId == 'undefined') {
                //             bId = dataItem.bibliography_id;
                //         }
                //         addItem(data, `{{ __('content.criminal') }}`);
                //     },
                //     faild: function(data) {
                //         alert(`{{ __('content.err') }}`);
                //     }
                // });
            }

            function selectRowCriminalCase(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'man') { ?>
                man_has_criminal_case(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                organization_has_criminal_case(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                event_has_criminal_case(dataItem.id);
                <?php } ?>
                <?php } ?>
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
