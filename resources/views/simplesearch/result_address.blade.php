@extends('layouts.include-app')

@section('content-include')


    <a class="closeButton"></a>
    <div id="example" class="k-content">
        <div style="width: 70%; text-align: left">
            <?php
            $keyArray = ['country_ate_idName', 'country_ate', 'region_local', 'region_idName', 'locality_local', 'locality_idName', 'street_local', 'street_idName', 'region', 'locality', 'street', 'track', 'home_num', 'housing_num', 'apt_num', 'content'];
            $params = json_decode(Session::get('search_params'), true);
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
                href="{{ route('simple_search_address', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
            <a class="k-button k-button-icontext k-grid-resetFilter"
                href="{{ route('simple_search_address', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
        </div>
        <div id="grid"></div>
        <div class="details"></div>
        {{-- </div>
                </div>
            </div>
    </section> --}}
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
                                },
                                created_at: {
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
                        text: "{{ __('content.clean_all') }}"
                    }],
                    filterable: {
                        extra: false,
                        operators: {
                            string: {
                                startswith: "{{ __('content.start') }}",
                                eq: "{{ __('content.equal') }}",
                                neq: "{{ __('content.not_equal') }}",
                                contains: "{{ __('content.contains') }}"
                            },
                            date: {
                                eq: "{{ __('content.equal') }}",
                                neq: "{{ __('content.not_equal') }}",
                                gt: "{{ __('content.more') }}",
                                gte: "{{ __('content.more_equal') }}",
                                lt: "{{ __('content.less') }}",
                                lte: "{{ __('content.less_equal') }}"

                            }
                        },
                        messages: {
                            info: "{{ __('content.search_as') }}",
                            filter: "{{ __('content.seek') }}",
                            clear: "{{ __('content.clean') }}",
                            and: "{{ __('content.and') }}",
                            or: "{{ __('content.or') }}"
                        }
                    },
                    columns: [{
                            command: {
                                name: "aJoin",
                                text: "<i class='bi bi-eye' style='width: 30px;height: 30px;font-size: 27px;' title='{{ __('content.view_ties') }}' ></i>",
                                click: showDetailsAddress
                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('address-edit') ) { ?> {
                            command: {
                                name: "aEdit",
                                text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                                click: editAddress
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
                                        eq: "{{ __('content.equal') }}",
                                        neq: "{{ __('content.not_equal') }}",
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
                            field: "country_ate",
                            width: "140px",
                            title: "{{ __('content.country_ate') }}"
                        },
                        {
                            field: "region",
                            width: "100px",
                            title: "{{ __('content.region') }}"
                        },
                        {
                            field: "locality",
                            width: "200px",
                            title: "{{ __('content.locality') }}"
                        },
                        {
                            field: "street",
                            width: "100px",
                            title: "{{ __('content.street') }}"
                        },
                        {
                            field: "track",
                            width: "290px",
                            title: "{{ __('content.track') }}"
                        },
                        {
                            field: "home_num",
                            width: "140px",
                            title: "{{ __('content.home_num') }}"
                        },
                        {
                            field: "housing_num",
                            width: "160px",
                            title: "{{ __('content.housing_num') }}"
                        },
                        {
                            field: "apt_num",
                            width: "175px",
                            title: "{{ __('content.apt_num') }}"
                        },
                        {
                            command: {
                                name: "aWord",
                                text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                                click: openWord
                            },
                            width: "90px"
                        },
                        <?php if(auth()->user()->roles()->first()->hasPermissionTo('address-delete')) { ?> {
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

                $('#addNewAddress').click(function(e) {
                    e.preventDefault();
                    var title = $(this).attr('title');
                    var tb_name = $(this).attr('fromTable');
                    $.ajax({
                        url: `/{{ app()->getLocale() }}/add/address/` + tb_name,
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
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                var confDel = confirm('{{ __('content.delete_entry') }}');
                if (confDel) {
                    $.ajax({
                        url: `/{{ app()->getLocale() }}/admin/optimization_address/`,
                        type: 'post',
                        data: {
                            'id': dataItem.id
                        },
                        success: function(data) {
                            $("#grid").data("kendoGrid").dataSource.remove(dataItem);
                        },
                        faild: function(data) {
                            alert('{{ __('content.err') }} ');
                        }
                    });
                }
            }

            function showDetailsAddress(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                $('.k-window-title').html("{{ __('content.ties_address') }}" + dataItem.id);
                wnd.refresh({
                    url: `/{{ app()->getLocale() }}/open/addressJoins/` + dataItem.id
                });
                wnd.center().open();
            }

            function openWord(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                window.open(`/{{ app()->getLocale() }}/word/address/` + dataItem.id, '_blank');
            }

            function editAddress(e) {
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                $.ajax({
                    url: `/{{ app()->getLocale() }}/add/address/edit/` + dataItem.id,
                    dataType: 'html',
                    success: function(data) {
                        addItem(data, '{{ __('content.address') }}');
                    },
                    faild: function(data) {
                        alert('{{ __('content.err') }}');
                    }
                });
            }

            function selectRowAddress(e) {
                e.preventDefault();
                var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'man') { ?>
                man_has_address(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                organization_has_address(dataItem.id);
                <?php }elseif($other_tb_name == 'organization_address') { ?>
                organization_address(dataItem.id);
                <?php }elseif($other_tb_name == 'event_address') { ?>
                event_address(dataItem.id);
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
