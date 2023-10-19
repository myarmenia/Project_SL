@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div id="example" class="k-content">
    <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("category", "view", "type", "model", "reg_num", "count", "content");
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
        href="{{ route('simple_search_weapon', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
        <a class="k-button k-button-icontext k-grid-resetFilter"
        href="{{ route('simple_search_weapon', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
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
                            created_at:{ type: "date" } ,
                            count : { type : 'number' }
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
                        click: showDetailsWeapon
                        },
                        width: "90px" },
                <?php if(auth()->user()->roles()->first()->hasPermissionTo('weapon-edit') ) { ?>
                { command: {
                    name:"aEdit",
                    text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                    click: editWeapon
                    },
                    width: "90px" },
            <?php } ?>
            { field: "id", width: "100px",title: "Id" ,filterable:{
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
            { field: "category",width: "100px", title: `{{ __('content.weapon_cat') }}`  },
            { field: "view",width: "100px", title: `{{ __('content.view') }}` },
            { field: "type", width: "100px",title: `{{ __('content.type') }}`  },
            { field: "model",width: "100px", title: `{{ __('content.mark') }}` },
            { field: "reg_num",width: "170px", title: `{{ __('content.account_number') }}`  },
            { field: "count",width: "120px", title: `{{ __('content.count') }}` ,
                    filterable:{
                ui: function (element) {
                    element.kendoNumericTextBox({
                        format: "n0"
                    });
                }
            }
            },
            <!--                { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--" , format: "{0:dd-MM-yyyy}",-->
                <!--                    filterable: {-->
<!--                        ui: setDatePicker,-->
<!--                        extra: true-->
<!--                    }-->
                <!--                },-->
            { command: {
                name:"aWord",
                text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                click: openWord
                },
                width: "90px" },
            <?php if(auth()->user()->roles()->first()->hasPermissionTo('weapon-delete')) { ?>
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
//                    content:`/${lang}/open/weaponJoins/`
                }).data("kendoWindow");

        $('#addNewWeapon').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:`/${lang}/add/weapon/`+tb_name,
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
                    url: `/${lang}/admin/optimization_weapon/`,
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

        function showDetailsWeapon(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html(`{{ __('content.ties_weapon') }}`+dataItem.id);
            wnd.refresh({ url: `/${lang}/open/weaponJoins/`+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open(`/${lang}/word/weapon/`+dataItem.id, '_blank' );
        }

        function editWeapon(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: `/${lang}/add/weapon/edit/`+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,`{{ __('content.weapon') }}`);
                },
                faild: function(data){
                    alert(`{{ __('content.err') }}`);
                }
            });
        }

        function selectRowWeapon(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'man') { ?>
                    man_has_weapon(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                    organization_has_weapon(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_has_weapon(dataItem.id);
                <?php } ?>
            <?php } ?>
        }

        function setDatePicker(element){
            element.kendoDatePicker({
                format: "dd-MM-yyyy"
            })
        }

    </script>
</div>

@endsection
@endsection
