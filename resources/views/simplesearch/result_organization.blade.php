@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div id="example" class="k-content">
    <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("name_organization", "nation", "country_idName", "reg_date", "region_activity", "country_ate_idName", "category_organization", "category_idName", "security_organization",
         "agency_idName", "employers_count", "opened_dou", "content");
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
          href="{{ route('simple_search_organization', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
        <a class="k-button k-button-icontext k-grid-resetFilter"
          href="{{ route('simple_search_organization', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>

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
                            id: { editable: false, nullable: false , type:'number'},
                            reg_date : { type: 'date' },
                            created_at : { type: 'date' } ,
                            employers_count : { type : 'number' }
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
                            gt: `{{ __('content.more') }}`,
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
                         click: showDetailsOrganization
                        },
                        width: "90px" },
                <?php if(auth()->user()->roles()->first()->hasPermissionTo('organization-edit') ) { ?>
                { command: {
                     name:"aEdit",
                     text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                     click: editOrganization
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
            { field: "name", width: "230px",title: `{{ __('content.name_organization') }}` },
            { field: "country",width: "325px", title: `{{ __('content.nation') }}` },
            { field: "reg_date",width: "315px", title: `{{ __('content.date_formation') }}`,  format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker ,
                        extra: true
            }
            },
            { field: "country_ate",width: "220px", title: `{{ __('content.region_activity') }}` },
            { field: "category",width: "235px", title: `{{ __('content.category_organization') }}`  },
            { field: "employers_count",width: "315px",  title: `{{ __('content.number_worker') }}`  ,
                    filterable:{
                ui: function (element) {
                    element.kendoNumericTextBox({
                        format: "n0"
                    });
                }
            }
            },
            { field: "attension", width: "128px",title: `{{ __('content.attention') }}` },
            { field: "opened_dou", width: "300px",title: `{{ __('content.organization_dow') }}`   },
            <!--                    { field: "created_at",width: "115px", title: `-->{{ __('content.created_at') }}<!--`,  format: "{0:dd-MM-yyyy}",-->
                <!--                        filterable: {-->
<!--                            ui: setDatePicker ,-->
<!--                            extra: true-->
<!--                        }-->
                <!--                    },-->
            { field: "agency",width: "530px", title: `{{ __('content.security_organization_for_grid') }}`  },
            { command: {
                name:"aWord",
                text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                click: openWord
             },
             width: "90px" },
            <?php if(auth()->user()->roles()->first()->hasPermissionTo('organization-delete')) { ?>
                { command: {
                    name: "aDelete",
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
//                    content:`/{{ app()->getLocale() }}/open/weaponJoins/'
                }).data("kendoWindow");

        $('#addNewOrganization').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url: `/{{ app()->getLocale() }}/add/organization/`+tb_name,
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
                    url: `/{{ app()->getLocale() }}/admin/optimization_organization/`,
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

        function showDetailsOrganization(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html(`{{ __('content.ties_organization') }}`+dataItem.id);
            wnd.refresh({ url: `/{{ app()->getLocale() }}/open/organizationJoins/`+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open(`/{{ app()->getLocale() }}/word/organization/`+dataItem.id, '_blank' );
        }

        function editOrganization(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: `/{{ app()->getLocale() }}/add/organization/`+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,`{{ __('content.organization') }}`);
                },
                faild: function(data){
                    alert(`{{ __('content.err') }}`);
                }
            });
        }

        function selectRowOrganization(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'organization') { ?>
                    organization_has_organization(dataItem.id);
                <?php }elseif($other_tb_name == 'objects_relation_org') { ?>
                    objects_relation_organization_to_organization(dataItem.id);
                <?php }elseif($other_tb_name == 'event_has_organization') { ?>
                    event_has_organization(dataItem.id);
                <?php }elseif($other_tb_name == 'event_organization') { ?>
                    event_organization(dataItem.id);
                <?php } ?>
            <?php } ?>
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



    </script>
</div>

@endsection
@endsection