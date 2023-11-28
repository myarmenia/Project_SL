@extends('layouts.include-app')

@section('content-include')

    <x-back-previous-url />
    <a class="closeButton"></a>
    <div id="example" class="k-content">

        <div id="grid"></div>
        <div class="details" id="table" data-tb-name="man"></div>


    @section('js-include')
        <script>
            let ties = "{{ __('content.ties') }}"
            let parent_table_name = "{{ __('content.man') }}"
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
                                birthday_y: {
                                    type: "number"
                                },
                                birthday_d: {
                                    type: "number"
                                },
                                birthday_m: {
                                    type: "number"
                                },
                                photo_count: {
                                    type: "number"
                                },
                                start_wanted: {
                                    type: "date"
                                },
                                entry_date: {
                                    type: "date"
                                },
                                exit_date: {
                                    type: "date"
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
                                contains: `{{ __('content.contains') }}`,
                                startswith: `{{ __('content.start') }}`,
                                eq: `{{ __('content.equal') }}`,
                                neq: `{{ __('content.not_equal') }}`,
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
                                // click: showDetailsMan
                                click: showDetailsRelation

                            },
                            width: "90px"
                        },
                        {
                            command: {
                                name: "aManFile",
                                text: "F",
                                click: showManFile<?php echo $_SESSION['counter']; ?>
                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('man-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editMan
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
                            field: "last_name",
                            width: "120px",
                            title: `{{ __('content.last_name') }}`
                        },
                        {
                            field: "first_name",
                            width: "120px",
                            title: `{{ __('content.first_name') }}`
                        },
                        {
                            field: "middle_name",
                            width: "120px",
                            title: `{{ __('content.middle_name') }}`
                        },
                        {
                            field: "birthday_d",
                            width: "120px",
                            title: `{{ __('content.date_of_birth_d') }}`,
                            filterable: {
                                extra: true,
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "birthday_m",
                            width: "120px",
                            title: `{{ __('content.date_of_birth_m') }}`,
                            filterable: {
                                extra: true,
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "birthday_y",
                            width: "100px",
                            title: `{{ __('content.date_of_birth_y') }}`,
                            filterable: {
                                extra: true,
                                ui: function(element) {
                                    element.kendoNumericTextBox({
                                        format: "n0"
                                    });
                                }
                            }
                        },
                        {
                            field: "country_ate",
                            width: "295px",
                            title: `{{ __('content.place_of_birth') }}`
                        },
                        {
                            field: "region_id",
                            width: "320px",
                            title: `{{ __('content.place_of_birth_area_local') }}`
                        },
                        {
                            field: "locality_id",
                            width: "350px",
                            title: `{{ __('content.place_of_birth_settlement_local') }}`
                        },
                        {
                            field: "approximate_year",
                            width: "260px",
                            title: `{{ __('content.approximate_year') }}`
                        },
                        {
                            field: "passport",
                            width: "175px",
                            title: `{{ __('content.passport_number') }}`
                        },
                        {
                            field: "gender",
                            width: "70px",
                            title: `{{ __('content.gender') }}`
                        },
                        {
                            field: "nation",
                            width: "175px",
                            title: `{{ __('content.nationality') }}`
                        },
                        {
                            field: "man_belongs_country",
                            width: "148px",
                            title: `{{ __('content.citizenship') }}`
                        },
                        {
                            field: "man_knows_language",
                            width: "160px",
                            title: `{{ __('content.knowledge_of_languages') }}`
                        },
                        {
                            field: "attention",
                            width: "125px",
                            title: `{{ __('content.attention') }}`
                        },
                        {
                            field: "more_data",
                            width: "309px",
                            title: `{{ __('content.additional_information_person') }}`
                        },

                        {
                            field: "occupation",
                            width: "140px",
                            title: `{{ __('content.occupation') }}`
                        },
                        {
                            field: "country_search_man",
                            width: "320px",
                            title: `{{ __('content.country_carrying_out_search') }}`
                        },
                        {
                            field: "operation_category",
                            width: "280px",
                            title: `{{ __('content.operational_category_person') }}`
                        },
                        {
                            field: "start_wanted",
                            width: "195px",
                            title: `{{ __('content.declared_wanted_list_with') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "entry_date",
                            width: "285px",
                            title: `{{ __('content.home_monitoring_start') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            field: "exit_date",
                            width: "270px",
                            title: `{{ __('content.end_monitoring_start') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },
                        {
                            hidden: true,
                            field: "bibliography_id"
                        },
                        {
                            field: "education",
                            width: "360px",
                            title: `{{ __('content.education') }}`
                        },
                        {
                            field: "party",
                            width: "150px",
                            title: `{{ __('content.party') }}`
                        },
                        {
                            field: "nickname",
                            width: "210px",
                            title: `{{ __('content.alias') }}`
                        },
                        {
                            field: "opened_dou",
                            width: "226px",
                            title: `{{ __('content.face_opened') }}`
                        },
                        {
                            field: "resource",
                            width: "290px",
                            title: `{{ __('content.source_information') }}`
                        },
                        {
                            field: "photo_count",
                            width: "80px",
                            title: `{{ __('content.short_photo') }}`,
                            filterable: {
                                extra: true,
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
                        @if (auth()->user()->roles()->first()->hasPermissionTo('man-delete'))
                            {
                                command: {
                                    name: "aDelete",
                                    text: "<i class='bi bi-trash3' style='width: 30px;height: 30px;font-size: 26px;' title=`{{ __('content.delete') }}` ></i>",
                                    click: tableDelete<?php echo $_SESSION['counter']; ?>
                                },
                                width: "90px"
                            }
                        @endif

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

                $('#addNewMan').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/${lang}/add/man/` + tb_name,
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

            // function showDetailsMan(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     $('.k-window-title').html(`{{ __('content.ties_man') }}`+dataItem.id);
            //     wnd.refresh({ url: `/${lang}/open/manJoins/`+dataItem.id });
            //     wnd.center().open();
            // }

            function showManFile<?php echo $_SESSION['counter']; ?>(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                $('.k-window-title').html(`{{ __('content.ties_man') }}` + dataItem.id);
                wnd.refresh({
                    url: `/${lang}/detail/man_file/` + dataItem.id
                });
                wnd.center().open();
            }

            // function openWord(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     window.open(`/${lang}/word/man_with_joins/` + dataItem.id, '_blank');
            // }

            function editMan(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                if ($.trim(dataItem.bibliography_id).length == 0) {
                    dataItem.bibliography_id = 'null';
                }
                location.href = `/${lang}/man/${dataItem.id}/edit`

                // $.ajax({
                //     url: `/${lang}/add/man/` + dataItem.bibliography_id + '/' + dataItem.id,
                //     dataType: 'html',
                //     success: function(data) {
                //         if (typeof bId == 'undefined') {
                //             bId = dataItem.bibliography_id;
                //         }
                //         addItem(data, `{{ __('content.face') }}`);
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
