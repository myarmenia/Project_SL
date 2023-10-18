@extends('layouts.include-app')

@section('content-include')

<a class="closeButton"></a>
<div id="example" class="k-content">
    <div style="width: 70%; text-align: left">
        @php
        $keyArray = array("from_agency_idName", "from_agency_name", "category_title", "category_idName", "access_level_name", "access_level_idName", "reg_number", "reg_date", "worker_name",
         "source_agency_name", "source_agency_idName", "source_address", "short_desc", "source", "related_year", "country", "country_idName", "theme", "title", "created_at", "content");
        $params = json_decode(session()->get('search_params'), true);

        if($params != null){
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
        }
        @endphp
    </div>

    <div style="text-align: right">
        <a class="k-button k-button-icontext k-grid-resetFilter"
        href="{{ route('simple_search_bibliography', ['locale' => app()->getLocale(), 'n' => 't']) }}">{{ __('content.new_search') }}</a>
        <a class="k-button k-button-icontext k-grid-resetFilter"
        href="{{ route('simple_search_bibliography', ['locale' => app()->getLocale(), 'n' => 'f']) }}">{{ __('content.change_search') }}</a>
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
                            created_at : { type: 'date' },
                            related_year : { type: 'number' },
                            file_count : { type: 'number' },
                            reg_date : { type: 'date' }
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
                            neq: `{{ __('content.not_equal') }}`,
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
                        click: showDetailsBibliography
                        },
                        width: "90px" },
                <?php if(Auth::user()->can('bibliography-edit') ) { ?>
                { command: {
                    name:"aEdit",
                    text: "<i class='bi bi-pencil-square' style='width: 30px;height: 30px;font-size: 26px;' title='{{ __('content.edit') }}' ></i>",
                    click: editBibliography
                    },
                    width: "90px" },
            <?php } ?>
            { field: "id",width:"100px",  title: "Id" ,
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
            { field: "user_name",width:"330px", title: "{{ __('content.created_user') }}" },
            { field: "created_at",width:"230px",  title: "{{ __('content.date_and_time_date') }}",  format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker ,
                        extra: true
            }
            },
            { field: "from_agency_name",width:"360px", title: `{{ __('content.organ') }}` },
            { field: "doc_category", width:"220px", title: `{{ __('content.document_category') }}` },
            { field: "access_level", width:"180px",  title: `{{ __('content.access_level') }}`  },
            { field: "reg_number",width:"125px", title: `{{ __('content.reg_number') }}`   },
            { field: "reg_date",width:"115px", title: `{{ __('content.reg_date') }}`, format: "{0:dd-MM-yyyy}",
                    filterable: {
                ui: setDatePicker ,
                        extra: true
            }
            },
            { field: "worker_name", width:"360px", title: `{{ __('content.worker_take_doc') }}` },
            { field: "source_agency_name", width:"380px", title: `{{ __('content.source_agency') }}`  },
            { field: "source_address",width:"355px", title: `{{ __('content.source_address') }}`  },
            { field: "short_desc", width:"315px", title: `{{ __('content.short_desc') }}`  },
            { field: "related_year", width:"270px", title: `{{ __('content.related_year') }}` ,
                    filterable:{
                ui: function (element) {
                    element.kendoNumericTextBox({
                        format: "n0"
                    });
                }
            }
            },
            { field: "source",width:"235px", title: `{{ __('content.source_inf') }}` },
            { field: "country", width:"290px",  title: `{{ __('content.information_country') }}`  },
            { field: "theme", width:"280px",  title: `{{ __('content.name_subject') }}`  },
            { field: "title", width:"280px",  title: `{{ __('content.title_document') }}`  },
            { field: "file_count", width:"80px",  title: `{{ __('content.file') }}`  },
            { field: "video", width:"80px",  title: `{{ __('content.short_video') }}`  ,
                    filterable:{
                ui: function (element) {
                    element.kendoNumericTextBox({
                        format: "n0"
                    });
                }
            }
            },
            { command: {
                name:"aWord",
                text: "<i class='bi bi-file-word' style='width: 50px;height: 30px;font-size: 26px;' title='{{ __('content.word') }}'></i>",
                click: openWord
                },
                width: "90px" },
            <?php if(Auth::user()->can('bibliography-delete')) { ?>
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

        $('#addNewBibliography').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:`/${lang}/add/bibliography/`+tb_name,
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
                    url: `/${lang}/admin/optimization_bibliography/`,
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid").data("kendoGrid").dataSource.remove(dataItem);
                    },
                    faild: function(data){
                        alert(`{{ __('content.err')}}`);
                    }
                });
            }
        }

        function showDetailsBibliography(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html(`{{ __('content.ties_bibliography') }}`+dataItem.id);
            wnd.refresh({ url: `/${lang}/open/bibliographyJoins/`+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open(`/${lang}/bibliography/downloadFile/`+dataItem.file_id, '_blank' );
        }

        function editBibliography(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: `/${lang}/bibliography/add/`+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,`{{ __('content.bibliography') }}`);
                },
                faild: function(data){
                    alert(`{{ __('content.err') }}`);
                }
            });
        }

        function selectRowBibliography(e){
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
        function setDatePicker(element){
            element.kendoDatePicker({
                format: "dd-MM-yyyy"
            })
        }


    </script>
</div>

@endsection
@endsection
