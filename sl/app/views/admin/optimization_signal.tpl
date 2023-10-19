<a class="closeButton"></a>
<div id="example" class="k-content" style="height: 600px;">

    <div id="grid_optimization_signal"></div>

    <div class="details"></div>

    <script>
        var wnd;
        $(document).ready(function () {
            var json = '<?php echo $data;?>';
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
                            subunit_date : { type: 'date' },
                            check_date : { type: 'date' },
                            end_date : { type: 'date' },
                            reg_num : { type : 'number'},
                            check_date_count : { type : 'number'},
                            check_line: { type: 'number' }
                        }
                    }
                }
            });

            var grid = $("#grid_optimization_signal").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                resizable: true,
                navigatable: true,
                sortable: true,
                height: 430,
                scrollable: true,
                dataBound: dataBound,
                toolbar: [{ name:'resetFilter' ,text: "<?php echo $Lang->clean_all; ?>" }] ,
                filterable: {
                    extra: false,
                    operators: {
                        string: {
                            startswith: "<?php echo $Lang->start; ?>",
                            eq: "<?php echo $Lang->equal; ?>",
                            neq: "<?php echo $Lang->not_equal; ?>",
                            contains: "<?php echo $Lang->contains; ?>"
                        },
                        date: {
                            eq: "<?php echo $Lang->equal; ?>",
                            neq: "<?php echo $Lang->not_equal; ?>" ,
                            gt:'<?php echo $Lang->more; ?>',
                            gte:'<?php echo $Lang->more_equal; ?>',
                            lt:'<?php echo $Lang->less; ?>',
                            lte:'<?php echo $Lang->less_equal; ?>'

                        },
                        number: {
                            eq: "<?php echo $Lang->equal; ?>",
                            neq: "<?php echo $Lang->not_equal; ?>" ,
                            gt:'<?php echo $Lang->more; ?>',
                            gte:'<?php echo $Lang->more_equal; ?>',
                            lt:'<?php echo $Lang->less; ?>',
                            lte:'<?php echo $Lang->less_equal; ?>'

                        }
                    },
                    messages: {
                        info: "<?php echo $Lang->search_as; ?>",
                        filter:'<?php echo $Lang->seek; ?>',
                        clear:'<?php echo $Lang->clean; ?>',
                        and: '<?php echo $Lang->and; ?>',
                        or: '<?php echo $Lang->or; ?>'
                    }
                },
                columns: [
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsSignal }, width: "90px" },
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editSignal }, width: "90px" },
                    { field: "id",width: "100px", title: "Id" ,filterable:{
                        extra: false,
                        operators : {
                            number : {
                                eq: "<?php echo $Lang->equal; ?>",
                                neq: "<?php echo $Lang->not_equal; ?>",
                            }
                        },
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    } },
                    { field: "reg_num",width: "290px", title: "<?php echo $Lang->reg_number_signal; ?>"  },
                    { field: "content",width: "360px", title: "<?php echo $Lang->contents_information_signal; ?>" },
                    { field: "check_line", width: "310px",title: "<?php echo $Lang->line_which_verified; ?>" ,
                        filterable:{
                            ui: function (element) {
                                element.kendoNumericTextBox({
                                    format: "n0"
                                });
                            }
                        }
                    },
                    { field: "check_status",width: "335px", title: "<?php echo $Lang->check_status_charter; ?>" },
                    { field: "signal_qualification", width: "380px", title: "<?php echo $Lang->qualifications_signaling; ?>" },
                    { field: "source_resource",width: "220px", title: "<?php echo $Lang->source_category; ?>"  },
                    { field: "check_unit",width: "280px", title: "<?php echo $Lang->checks_signal; ?>" },
                    { field: "check_agency",width: "335px", title: "<?php echo $Lang->department_checking; ?>" },
                    { field: "check_subunit",width: "360px", title: "<?php echo $Lang->unit_testing; ?>" },
                    { field: "checking_worker",width: "310px", title: "<?php echo $Lang->name_checking_signal; ?>" },
                    { field: "checking_worker_post",width: "270px", title: "<?php echo $Lang->worker_post; ?>" },
                    { field: "subunit_date",width: "400px", title: "<?php echo $Lang->date_registration_division; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "check_date",width: "395px", title: "<?php echo $Lang->check_date; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "end_date", width: "400px",title: "<?php echo $Lang->date_actual_word; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "check_date_id", width: "350px",title: "<?php echo $Lang->check_previously; ?>"},
                    { field: "check_date_count", width: "150px", title: "< <?php echo $Lang->count; ?>" ,
                        filterable:{
                            ui: function (element) {
                                element.kendoNumericTextBox({
                                    format: "n0"
                                });
                            }
                        }},
                    { field: "resource_id",width: "310px", title: "<?php echo $Lang->useful_capabilities; ?>" },
                    { field: "signal_result",width: "215px", title: "<?php echo $Lang->signal_results; ?>" },
                    { field: "taken_measure",width: "175px", title: "<?php echo $Lang->measures_taken; ?>"  },
                    { field: "opened_dou",width: "380px", title: "<?php echo $Lang->according_result_dow; ?>" },
                    { field: "opened_agency",width: "340px", title: "<?php echo $Lang->brought_signal; ?>" },
                    { field: "opened_unit", width: "295px",title: "<?php echo $Lang->department_brought; ?>" },
                    { field: "opened_subunit", width: "370px", title: "<?php echo $Lang->unit_brought; ?>" },
                    { field: "worker",width: "310px", title: "<?php echo $Lang->name_operatives; ?>" },
                    { field: "worker_post",width: "270px", title: "<?php echo $Lang->worker_post; ?>" },

<!--                    { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--",  format: "{0:dd-MM-yyyy}",-->
<!--                        filterable: {-->
<!--                            ui: setDatePicker,-->
<!--                            extra: true-->
<!--                        }-->
<!--                    },-->
                    { command: { name:"aDelete", text: "<img src='<?php echo ROOT; ?>images/delete.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->delete; ?>' >", click: tableDelete }, width: "90px" }

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

        $('#addNewSignal').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'<?php echo ROOT; ?>add/signal/'+tb_name,
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

        });

        function showDetailsSignal(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_signal; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/signalJoins/'+dataItem.id });
            wnd.center().open();
        }

        function tableDelete(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            var confDel = confirm('<?php echo $Lang->delete_entry;?>');
            if(confDel){
                $.ajax({
                    url: '<?php echo ROOT?>admin/optimization_signal/',
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid_optimization_signal").data("kendoGrid").dataSource.remove(dataItem);
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            }
        }

        function editSignal(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: '<?php echo ROOT?>add/signal/'+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,'<?php echo $Lang->signal; ?>');
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?>');
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