@extends('layouts.include-app')

@section('content-include')

    <x-back-previous-url />
    <a class="closeButton"></a>
    <div id="example" class="k-content">

        <div id="grid"></div>

        <div class="details" id="table" data-tb-name="event"></div>


    @section('js-include')
        <script>
           
            let parent_table_name = "{{ __('content.event') }}"
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
                                date: {
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
                                // click: showDetailsEvent
                                click: showDetailsRelation

                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('event-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editEvent
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
                            field: "qualification",
                            width: "245px",
                            title: `{{ __('content.qualification_event') }}`
                        },
                        {
                            field: "date",
                            width: "275px",
                            title: `{{ __('content.date_security_date') }}`,
                            format: "{0:dd-MM-yyyy}",
                            filterable: {
                                ui: setDatePicker,
                                extra: true
                            }
                        },

                        {
                            field: "aftermath",
                            width: "380px",
                            title: `{{ __('content.ensuing_effects') }}`
                        },
                        {
                            field: "result",
                            width: "320px",
                            title: `{{ __('content.results_event') }}`
                        },
                        {
                            field: "agency",
                            width: "245px",
                            title: `{{ __('content.investigation_requested') }}`
                        },
                        {
                            field: "resource",
                            width: "335px",
                            title: `{{ __('content.source_event') }}`
                        },
                        // {
                        //     command: {
                        //         name: "aWord",
                        //         text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                        //         click: openWord
                        //     },
                        //     width: "90px"
                        // },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('event-delete') ) { ?> {
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

                $('#addNewEvent').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/${lang}/add/event/` + tb_name,
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

            // function showDetailsEvent(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     $('.k-window-title').html(`{{ __('content.event') }}` + dataItem.id);
            //     wnd.refresh({
            //         url: `/${lang}/open/eventJoins/` + dataItem.id
            //     });
            //     wnd.center().open();
            // }

            // function openWord(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     window.open(`/${lang}/word/event/` + dataItem.id, '_blank');
            // }

            function editEvent(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                location.href = `/${lang}/event/${dataItem.id}/edit`

                // $.ajax({
                //     url: `/${lang}/add/event/` + dataItem.bibliography_id + '/' + dataItem.id,
                //     dataType: 'html',
                //     success: function(data) {
                //         if (typeof bId == 'undefined') {
                //             bId = dataItem.bibliography_id;
                //         }
                //         addItem(data, `{{ __('content.event') }}`);
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
