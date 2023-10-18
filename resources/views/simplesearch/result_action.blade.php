@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div id="example" class="k-content">
     <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("material_content", "action_qualification_idName", "duration_idName", "goal_idName", "terms_idName", "aftermath_idName", "source", "opened_dou", "action_qualification",
         "duration_name", "goal_name", "terms_name", "aftermath_name", "start_date", "end_date", "content");
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
        href="{{ route('simple_search_action', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
        <a class="k-button k-button-icontext k-grid-resetFilter"
        href="{{ route('simple_search_action', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
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
                            id: { type: "number" , editable: false, nullable: false },
                            start_date:{ type: "date" },
                            end_date:{ type: "date" },
                            man_count: {type:'number'}
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

                        },
                        number: {
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
                        click: showDetailsAction
                        },
                        width: "90px" },
                <?php if(Auth::user()->can('action-edit') ) { ?>
                { command: {
                    name:"aEdit",
                    text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                    click: editAction
                    },
                    width: "90px" },
            <?php } ?>
            { field: "id",width: "100px", title: "Id" ,
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
            }
            },
            { field: "material_content", width: "330px",title: `{{ __('content.content_materials_actions') }}`  },
            { field: "action_qualification",width: "355px",  title: `{{ __('content.qualification_fact') }}` },
            { field: "man_count",width: "80px", title: `{{ __('content.face') }}`  ,
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
            }
            },
            { field: "start_date",width: "340px", title: `{{ __('content.start_action_date') }}`,  format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker,
                        extra: true
            }
            },
            { field: "end_date",width: "335px", title: `{{ __('content.end_action_date') }}`,  format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker,
                        extra: true
            }
            },
            { field: "duration",width: "295px", title: `{{ __('content.duration_action') }}`  },
            { field: "action_goal",width: "330px", title: `{{ __('content.purpose_motive_reason') }}`  },
            { field: "terms", width: "300px", title: `{{ __('content.terms_actions') }}` },
            { field: "aftermath",width: "380px", title: `{{ __('content.ensuing_effects') }}` },

            { field: "source", width: "335px", title: `{{ __('content.source_information_actions') }}`   },
            { field: "opened_dou",width: "155px", title: `{{ __('content.opened_dou') }}`   },
            { command: {
                name:"aWord",
                text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                click: openWord
                },
                width: "90px" } ,
            <?php if(Auth::user()->can('action-delete')) { ?>
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

        $('#addNewAction').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:`/${lang}/add/action/`+tb_name,
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

        });

        function showDetailsAction(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html(`{{ __('content.ties_action') }}`+dataItem.id);
            wnd.refresh({ url: `/${lang}/open/actionJoins/`+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open(`/${lang}/word/action/`+dataItem.id, '_blank' );
        }

        function setDateTimeP(element) {
            element.kendoDateTimePicker({
                format: "dd-MM-yyyy HH:mm",
                timeFormat: "HH:mm"
            });
        }

        function editAction(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: `/${lang}/add/action/`+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,`{{ __('content.action') }}`);
                },
                faild: function(data){
                    alert(`{{ __('content.err') }}`);
                }
            });
        }

        function setDatePicker(element){
            element.kendoDatePicker({
                format: "dd-MM-yyyy"
            })
        }
        function selectRowAction(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'man') { ?>
                    man_has_action(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                    organization_has_action(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_action_has_event(dataItem.id);
                <?php }elseif($other_tb_name == 'event_has_action') { ?>
                    event_event_has_action(dataItem.id);
                <?php }elseif($other_tb_name == 'signal_check') { ?>
                    signal_action_passes_by_signal(dataItem.id);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_action(dataItem.id);
                <?php } ?>
            <?php } ?>
        }

        function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            var confDel = confirm(`{{ __('content.delete_entry') }}`);
            if(confDel){
                $.ajax({
                    url: `/${lang}/admin/optimization_action/`,
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


    </script>
</div>

@endsection
@endsection
