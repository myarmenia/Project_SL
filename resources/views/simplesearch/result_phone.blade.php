@extends('layouts.include-app')

@section('content-include')

    <a class="closeButton"></a>
    <div id="example" class="k-content">
        <div style="width: 70%; text-align: left">
            <?php
            $keyArray = ['number', 'nature_character', 'character_man_idName', 'character_organization', 'character_organization_idName', 'more_data', 'content'];
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
                href="{{ route('simple_search_phone', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
            <a class="k-button k-button-icontext k-grid-resetFilter"
                href="{{ route('simple_search_phone', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
        </div>
        <div id="grid"></div>
        <div class="details"></div>
    @section('js-include')
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
                                click: showDetailsPhone
                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('phone-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editPhone<?php echo $_SESSION['counter']; ?>
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
                            width: "220px",
                            title: `{{ __('content.phone_number') }}`
                        },

                        {
                            field: "character_man",
                            width: "200px",
                            title: `{{ __('content.nature_character_man') }}`
                        },
                        {
                            field: "character_organization",
                            width: "260px",
                            title: `{{ __('content.nature_character_organization') }}`
                        },
                        {
                            field: "more_data",
                            width: "260px",
                            title: `{{ __('content.additional_data') }}`
                        },
                        // { command: {
                        //     name:"aWord",
                        //     text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                        //     click: openWord
                        //     },
                        //     width: "90px" },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('phone-delete')) { ?> {
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
                        //                    content:`/{{ app()->getLocale() }}/open/weaponJoins/`
                    }).data("kendoWindow");

                $('#addNewPhone').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/{{ app()->getLocale() }}/add/phone/` + tb_name,
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

            function showDetailsPhone(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                $('.k-window-title').html(`{{ __('content.ties_phone') }}` + dataItem.id);
                wnd.refresh({
                    url: `/{{ app()->getLocale() }}/open/phoneJoins/` + dataItem.id
                });
                wnd.center().open();
            }

            // function openWord(e) {
            //     e.preventDefault();
            //     var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            //     window.open(`/{{ app()->getLocale() }}/word/phone/`+dataItem.id, '_blank' );
            // }

            function selectRowPhone(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'man') { ?>
                man_has_address(dataItem.id);
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

            function editPhone<?php echo $_SESSION['counter']; ?>(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                $.ajax({
                    url: `/{{ app()->getLocale() }}/add/phone/edit/` + dataItem.id,
                    dataType: 'html',
                    success: function(data) {
                        if (typeof bId == 'undefined') {
                            bId = 'null';
                        }
                        addItem(data, `{{ __('content.telephone_number') }} id:` + dataItem.id);
                    },
                    faild: function(data) {
                        alert(`{{ __('content.err') }}`);
                    }
                });
            }
        </script>
    </div>
@endsection
@endsection
