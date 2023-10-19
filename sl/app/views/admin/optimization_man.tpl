<a class="closeButton"></a>
<div id="example" class="k-content" style="height: 600px;">

    <div id="grid_optimization_man"></div>
    <div class="details" style= ""></div>
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
                            birthday:{ type: "date" },
                            start_wanted:{ type: "date" },
                            entry_date:{ type: "date" },
                            exit_date:{ type: "date" }
                        }
                    }
                }
            });

            var grid = $("#grid_optimization_man").kendoGrid({
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsMan }, width: "90px" },
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editMan }, width: "90px" },
                    { field: "id",width: "100px",  title: "Id" ,filterable:{
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
                    { field: "last_name",width: "110px", title: "<?php echo $Lang->last_name; ?>" },
                    { field: "first_name",width: "70px", title: "<?php echo $Lang->first_name; ?>"  },
                    { field: "middle_name",width: "115px", title: "<?php echo $Lang->middle_name; ?>"  },
                    { field: "birthday",width: "325px", title: "<?php echo $Lang->date_of_birth; ?>" , format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "country_ate",width: "295px", title: "<?php echo $Lang->place_of_birth; ?>" },
                    { field: "region_id",width: "320px", title: "<?php echo $Lang->place_of_birth_area_local; ?>" },
                    { field: "locality_id",width: "350px", title: "<?php echo $Lang->place_of_birth_settlement_local; ?>" },
                    { field: "approximate_year",width: "260px", title: "<?php echo $Lang->approximate_year; ?>"},
                    { field: "passport",width: "175px", title: "<?php echo $Lang->passport_number; ?>"  },
                    { field: "gender",width: "70px", title: "<?php echo $Lang->gender; ?>"  },
                    { field: "nation",width: "175px", title: "<?php echo $Lang->nationality; ?>" },
                    { field: "country",width: "148px", title: "<?php echo $Lang->citizenship; ?>" },
                    { field: "language",width: "160px", title: "<?php echo $Lang->knowledge_of_languages; ?>" },
                    { field: "attention",width: "125px", title: "<?php echo $Lang->attention; ?>"   },
                    { field: "more_data",width: "309px", title: "<?php echo $Lang->additional_information_person; ?>"   },
                    { field: "occupation",width: "140px", title: "<?php echo $Lang->occupation; ?>"   },
                    { field: "country",width: "320px", title: "<?php echo $Lang->country_carrying_out_search; ?>" },
                    { field: "operation_category",width: "280px", title: "<?php echo $Lang->operational_category_person; ?>" },
                    { field: "start_wanted",width: "195px", title: "<?php echo $Lang->declared_wanted_list_with; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "entry_date",width: "285px", title: "<?php echo $Lang->home_monitoring_start; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "exit_date",width: "270px", title: "<?php echo $Lang->end_monitoring_start; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "education",width: "360px", title: "<?php echo $Lang->education; ?>" },
                    { field: "party", width: "150px",title: "<?php echo $Lang->party; ?>" },
                    { field: "nickname", width: "210px",title: "<?php echo $Lang->alias; ?>" },
                    { field: "opened_dou",width: "226px", title: "<?php echo $Lang->face_opened; ?>"   },
                    { field: "resource", width: "290px",title: "<?php echo $Lang->source_information; ?>"},
                    { field: "citizenship",width: "150px", title: "<?php echo $Lang->citizenship; ?>" },
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

        $('#addNewMan').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'<?php echo ROOT; ?>add/man/'+tb_name,
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

        });

        function showDetailsMan(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_man; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/manJoins/'+dataItem.id });
            wnd.center().open();
        }

        function tableDelete(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            var confDel = confirm('<?php echo $Lang->delete_entry;?>');
            if(confDel){
                $.ajax({
                    url: '<?php echo ROOT?>admin/optimization_man/',
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid_optimization_man").data("kendoGrid").dataSource.remove(dataItem);
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            }
        }

        function editMan(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: '<?php echo ROOT?>add/man/'+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,'<?php echo $Lang->face; ?>');
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
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
        function selectRowMan(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'work_activity') { ?>
                    work_activity_man(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_has_man(dataItem.id);
                <?php } ?>
            <?php } ?>
        }



    </script>
</div>