@extends('layouts.include-app')

@section('content-include')

    <x-back-previous-url />
    <a class="closeButton"></a>

    <div id="example" class="k-content">

        <div id="grid"></div>

        <div class="details" id="table" data-tb-name="bibliography"></div>


    @section('js-include')
        <script>
            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.bibliography') }}"
        </script>
        <script src='{{ asset('assets/js/contact/contact.js') }}'></script>
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
                                related_year: {
                                    type: 'number'
                                },
                                file_count: {
                                    type: 'number'
                                },
                                created_at: {
                                    type: 'date'
                                },
                                reg_date: {
                                    type: 'date'
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
                                // click: showDetailsBibliography
                                click: showDetailsRelation

                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('bibliography-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editBibliography
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
                            field: "user_name",
                            width: "330px",
                            title: `{{ __('content.created_user') }}`
                        },
                        {
                            field: "created_at",
                            width: "230px",
                            title: `{{ __('content.date_and_time_date') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "from_agency_name",
                            width: "357px",
                            title: `{{ __('content.organ') }}`
                        },
                        {
                            field: "access_level",
                            width: "175px",
                            title: `{{ __('content.access_level') }}`
                        },
                        {
                            field: "reg_number",
                            width: "125px",
                            title: `{{ __('content.reg_number') }}`
                        },
                        {
                            field: "reg_date",
                            width: "115px",
                            title: `{{ __('content.reg_date') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "worker_name",
                            width: "210px",
                            title: `{{ __('content.worker_take_doc') }}`
                        },
                        {
                            field: "source_agency_name",
                            width: "375px",
                            title: `{{ __('content.source_agency') }}`
                        },
                        {
                            field: "source_address",
                            width: "345px",
                            title: `{{ __('content.source_address') }}`
                        },
                        {
                            field: "short_desc",
                            width: "305px",
                            title: `{{ __('content.short_desc') }}`
                        },
                        {
                            field: "related_year",
                            width: "260px",
                            title: `{{ __('content.related_year') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "source",
                            width: "230px",
                            title: `{{ __('content.source_inf') }}`
                        },
                        {
                            field: "country",
                            width: "290px",
                            title: `{{ __('content.information_country') }}`
                        },
                        {
                            field: "theme",
                            width: "280px",
                            title: `{{ __('content.name_subject') }}`
                        },
                        {
                            field: "title",
                            width: "280px",
                            title: `{{ __('content.title_document') }}`
                        },
                        {
                            field: "file_count",
                            width: "80px",
                            title: `{{ __('content.file') }}`
                        },
                        {
                            field: "video",
                            width: "80px",
                            title: `{{ __('content.short_video') }}`,
                            filterable: {
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        // {
                        //     command: {
                        //         name: "aWord",
                        //         text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                        //         click: openWord
                        //     },
                        //     width: "90px"
                        // },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('bibliography-delete')) { ?> {
                            command: {
                                name: "aDelete",
                                text: "<i class='bi bi-trash3' style='width: 30px;height: 30px;font-size: 26px;' title=`{{ __('content.delete') }}` ></i>",
                                click: tableDelete<?php echo $_SESSION['counter']; ?>
                            },
                            width: "90px"
                        },
                        <?php } ?>
                    ],
                    dataSource: dataSource,
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

                $('#addNewBibliography').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/${lang}/add/bibliography/` + tb_name,
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

            // function showDetailsBibliography(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     $('.k-window-title').html(`{{ __('content.ties_bibliography') }}`+dataItem.id);
            //     wnd.refresh({ url: `/${lang}/open/bibliographyJoins/`+dataItem.id });
            //     wnd.center().open();
            // }

            // function openWord(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     window.open(`/${lang}/word/bibliography_with_joins/`+dataItem.id, '_blank' );
            // }

            function editBibliography(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                location.href = `/${lang}/bibliography/${dataItem.id}/edit`

                // $.ajax({
                //     url: `/${lang}/bibliography/add/` + dataItem.id,
                //     dataType: 'html',
                //     success: function(data) {
                //         addItem(data, `{{ __('content.bibliography') }}`);
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
