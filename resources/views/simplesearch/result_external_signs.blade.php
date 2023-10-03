@extends('layouts.auth-app')
@section('style')
    {{-- <link href="{{ asset('assets/css/roles/style.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('assets-include/css/jquery.fancybox.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets-include/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-include/js/jquery.fancybox.js') }}"></script>
    <link href="{{ asset('assets-include/css/kendo.common.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-include/css/kendo.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets-include/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets-include/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('assets-include/js/fileuploader.js') }}"></script>
    <script src="{{ asset('assets-include/js/ru.js') }}"></script>
@endsection
@section('content')
<a class="closeButton"></a>
<div id="example" class="k-content">
    <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("fixed_date", "signs", "sign_idName", "content");
        $params = json_decode($_SESSION['search_params'], true);
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
        <a class="k-button k-button-icontext k-grid-resetFilter" href="simplesearch/simple_search_external_signs?n=t">{{ __('content.new_search') }}</a>
        <a class="k-button k-button-icontext k-grid-resetFilter" href="simplesearch/simple_search_external_signs?n=f">{{ __('content.change_search') }}</a>
    </div>
    <div id="grid"></div>
    <div class="details"></div>
    @section('js-scripts')
    <script>
        var wnd;
        $(document).ready(function () {
            var json = `{{ $data}}`;
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
                            created_at : { type: 'date' }
                        }
                    }
                }
            });

            var grid = $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                resizable: true,
                sortable: true,
                navigatable: true,
                height: 430,
                scrollable: true,
                dataBound: dataBound,
                toolbar: [{ name:'resetFilter' ,text: "`{{ __('content.clean_all') }}`" }] ,
                filterable: {
                    extra: false,
                    operators: {
                        string: {
                            startswith: "`{{ __('content.start') }}`",
                            eq: "`{{ __('content.equal') }}`",
                            neq: "`{{ __('content.not_equal') }}`",
                            contains: "`{{ __('content.contains') }}`"
                        },
                        date: {
                            eq: "`{{ __('content.equal') }}`",
                            neq: "`{{ __('content.not_equal') }}`" ,
                            gt:"`{{ __('content.more') }}`",
                            gte:"`{{ __('content.more_equal') }}`",
                            lt:"`{{ __('content.less') }}`",
                            lte:"`{{ __('content.less_equal') }}`"

                        }
                    },
                    messages: {
                        info: "`{{ __('content.search_as') }}`",
                        filter:"`{{ __('content.seek') }}`",
                        clear:"`{{ __('content.clean') }}`",
                        and: "`{{ __('content.and') }}`",
                        or: "`{{ __('content.or') }}`"
                    }
                },
                columns: [
                    { command: { name:"aJoin", text: "<img src='images/view.png' style='width: 30px;height: 30px;' title='`{{ __('content.view_ties') }}`' >", click: showDetailsExternalSigns }, width: "90px" },
                <?php if($user_type != 3 ) { ?>
                { command: { name:"aEdit", text: "<img src='images/edit.png' style='width: 30px;height: 30px;' title='`{{ __('content.edit') }}`' >" , click: editManExternalSign }, width: "90px" },
            <?php } ?>
            { field: "id", width: "100px", title: "Id" ,
                    filterable:{
                extra: false,
                        operators : {
                    number : {
                        eq: "`{{ __('content.equal') }}`",
                                neq: "`{{ __('content.not_equal') }}`",
                    }
                },
                ui: function (element) {
                    element.kendoNumericTextBox({
                        format: "n0"
                    });
                }
            } },
            { field: "name", title: "`{{ __('content.signs') }}`"  },
            { field: "fixed_date", title: "`{{ __('content.time_fixation') }}`"  },
            { field: "man_id", title: "`{{ __('content.face') }}`"  },
            { command: { name:"aWord", text: "<img src='images/word.gif' style='width: 30px;height: 30px;' title='`{{ __('content.word') }}`' >", click: openWord }, width: "90px" },
            <?php if($user_type == 1) { ?>
                { command: { name:"aDelete", text: "<img src='images/delete.png' style='width: 30px;height: 30px;' title='`{{ __('content.delete') }}`' >", click: tableDelete<?php echo $_SESSION['counter']; ?> }, width: "90px" }
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
//                    content:'<?php echo ROOT; ?>open/weaponJoins/'
                }).data("kendoWindow");

        $('#addNewExternalSigns').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'add/external_signs/'+tb_name,
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
                    url: 'admin/optimization_external_sign/',
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

        function showDetailsExternalSigns(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("`{{ __('content.ties_external_signs') }}`"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/externalSignsJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('word/external_signs/'+dataItem.man_id, '_blank' );
        }

        function editManExternalSign(e){
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: 'add/external_signs/edit/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,`{{ __('content.external_signs') }}`);
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




    </script>
</div>
@endsection
@endsection
