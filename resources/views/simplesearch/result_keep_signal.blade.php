@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div id="example" class="k-content">
    <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("management_signal", "agency_idName", "department_checking_signal", "unit_idName", "unit_signal", "sub_unit_idName", "worker", "worker_post", "worker_post_idName",
         "start_date", "end_date", "pass_date", "pased_sub_unit_name", "pased_sub_unitName", "content");
        $params = json_decode(session()->get('search_params'), true);
        foreach ($params as $key=>$value ){
            if (gettype($value) == 'array' &&  in_array($key, $keyArray)) {
                foreach ($value as $val) {
                    if ($val != '')
                    echo $val . '; ' ;
            }
            } elseif ($value != '' && gettype($value) == 'string' &&  in_array($key, $keyArray)) {
                echo $value, '; ';
            }
        }
        ?>
    </div>
    <div style="text-align: right">
        <a class="k-button k-button-icontext k-grid-resetFilter"
        href="{{ route('simple_search_keep_signal', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
        <a class="k-button k-button-icontext k-grid-resetFilter"
        href="{{ route('simple_search_keep_signal', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
    </div>
    <div id="grid"></div>

    <div class="details"></div>

@section('js-include')

    <script>
        var wnd;
        $(document).ready(function () {
            var json = `{{ $data }}`;
            var data = $.parseJSON(json.replace(/\n/g,"\\n"));
            dataSource = new kendo.data.DataSource({
                type:'odata',
                data:data,
                batch: true,
                pageSize: 20,
                schema: {
                    model: {
                        id: "id",
                        fields: {
                            id: { editable: false, nullable: false, type:'number' },
                            start_date : { type: 'date' },
                            end_date : { type: 'date' },
                            pass_date : { type: 'date' }
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
                toolbar: [{ name:'resetFilter' ,text: `{{ __('content.clean_all') }}` }] ,
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
                            neq: `{{ __('content.not_equal') }}` ,
                            gt:`{{ __('content.more') }}`,
                            gte:`{{ __('content.more_equal') }}`,
                            lt:`{{ __('content.less') }}`,
                            lte:`{{ __('content.less_equal') }}`

                        }
                    },
                    messages: {
                        info: `{{ __('content.search_as') }}`,
                        filter:`{{ __('content.seek') }}`,
                        clear:`{{ __('content.clean') }}`,
                        and: `{{ __('content.and') }}`,
                        or: `{{ __('content.or') }}`
                    }
                },
                columns: [
                    { command: {
                        name:"aJoin",
                        text: "<i class='bi bi-eye' style='width: 30px;height: 30px;font-size: 27px;' title='{{ __('content.view_ties') }}' ></i>",
                        click: showDetailsKeepSignal
                        },
                        width: "90px" },
                <?php if(auth()->user()->roles()->first()->hasPermissionTo('keep_signal-edit') ) { ?>
                { command: {
                    name:"aEdit",
                    text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                    click: editKeepSignal
                    },
                    width: "90px" },
            <?php } ?>
            { field: "id",width: "100px",  title: "Id" ,
                    filterable:{
                extra: false,
                        operators : {
                    number : {
                        eq: `{{ __('content.equal') }}`,
                        neq: `{{ __('content.not_equal') }}`,
                    }
                },
                ui: function (element) {
                    element.kendoNumericTextBox({
                        format: "n0"
                    });
                }
            } },
            { field: "agency",width: "330px", title: `{{ __('content.management_signal') }}`  },
            { field: "unit",width: "285px", title: `{{ __('content.department_checking_signal') }}` },
            { field: "sub_unit", width: "360px", title: `{{ __('content.unit_signal') }}`  },

            { field: "worker", width: "290px",title: `{{ __('content.name_operatives') }}` },
            { field: "worker_post",width: "270px", title: `{{ __('content.worker_post') }}` },
            { field: "start_date",width: "257px",  title: `{{ __('content.start_checking_signal') }}`,  format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker ,
                        extra: true
            }
            },
            { field: "end_date", width: "245px",title: `{{ __('content.end_checking_signal') }}`,  format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker ,
                        extra: true
            }
            },
            { field: "pass_date",width: "340px", title: `{{ __('content.date_transfer_unit') }}` ,  format: "{0:dd-MM-yyyy}" ,
                    filterable: {
                ui: setDatePicker ,
                        extra: true
            }
            },
            { field: "pased_sub_unit",width: "360px", title: `{{ __('content.unit_signal_transmitted') }}`  },
            { command: {
                name:"aWord",
                text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                click: openWord
                },
                width: "90px" },
            <?php if(auth()->user()->roles()->first()->hasPermissionTo('keep_signal-delete')) { ?>
                { command: {
                    name:"aDelete",
                    text: "<i class='bi bi-trash3' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.delete') }}' ></i>",
                    click: tableDelete<?php echo $_SESSION['counter']; ?>
                    },
                    width: "90px" }
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
                    actions: ["Minimize","Maximize", "Close"],
                    width: 600,
                    height: 450

                }).data("kendoWindow");

        $('#addNewKeepSignal').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:`/${lang}/add/keep_signal/`+tb_name,
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

        });

        function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            var confDel = confirm(`{{ __('content.delete_entry') }}`);
            if(confDel){
                $.ajax({
                    url: `/${lang}/admin/optimization_keep_signal/`,
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid").data("kendoGrid").dataSource.remove(dataItem);
                    },
                    faild: function(data){
                        alert(`{{ __('content.err') }}`);
                    }
                });
            }
        }

        function showDetailsKeepSignal(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html(`{{ __('content.ties_keep_signal') }}`+dataItem.id);
            wnd.refresh({ url: `/${lang}/open/keepSignalJoins/`+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open(`/${lang}/word/keep_signal/`+dataItem.id, '_blank' );
        }

        function editKeepSignal(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: `/${lang}/add/keep_signal/edit/`+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,`{{ __('content.keep_signal') }}`);
                },
                faild: function(data){
                    alert(`{{ __('content.err') }}`);
                }
            });
        }

        function setDateTimeP(element) {
            element.kendoDateTimePicker({
                format: "dd-MM-yyyy HH:mm",
                timeFormat: "HH:mm"
            });
        }
        function setDatePicker(element){
            element.kendoDatePicker({
                format: "dd-MM-yyyy"
            })
        }
        function selectRowKeepSignal(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'man_use') { ?>
                    man_use_car(dataItem.id);
                <?php }elseif($other_tb_name == 'man') { ?>
                    man_has_car(dataItem.id);
                <?php } ?>
            <?php } ?>
        }



    </script>
</div>

@endsection
@endsection