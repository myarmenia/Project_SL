<div id="example" class="k-content">
    <?php if(isset($other_tb_name) || isset($old_counter)){ ?><a class="closeButton"></a><?php }?>
    <?php if(isset($other_tb_name) || isset($old_counter)){
        if($other_tb_name == 'bibliography' || isset($old_counter)) { ?>
         <div style="padding: 20px;"><input type="button" id="addNewMan<?php echo $_SESSION['counter']; ?>" class="k-button" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->face; ?>" value="<?php echo $Lang->createNew; ?>" /></div>
    <?php }
    } ?>
    <div id="grid_man_open<?php echo $_SESSION['counter'];?>"></div>

    <div class="details" style= ""></div>

    <script>
        var wnd;
        $(document).ready(function () {
            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url:"<?php echo ROOT;?>open/man/read",
                        dataType: "json",
                        type:'post'
                    },
                    parameterMap: function(data, type) {
                        if(typeof data.filter != 'undefined' && data.filter){
                            $.each(data.filter.filters,function(key,val){
                                if(typeof val.logic == 'undefined'){
                                    if(val.field == 'birthday' || val.field == 'start_wanted' || val.field == 'entry_date' || val.field == 'exit_date'){
                                        var a = new Date(val.value);
                                        data.filter.filters[key].value = a.toDateString();
                                    }
                                }else{
                                    $.each(val.filters,function(k,v){
                                        if(v.field != 'birthday_y' && v.field != 'birthday_d' && v.field != 'birthday_m' && v.field != 'photo_count'){
                                            var a = new Date(v.value);
                                            data.filter.filters[key].filters[k].value = a.toDateString();
                                        }
                                    });
                                }
                            });
                        }
                        return data;
                    }
                },
                batch: true,
                pageSize: 20,
                schema: {
                    data:'data',
                    total:'count',
                    model: {
                        id: "id",
                        fields: {
                            id: { editable: false, nullable: false ,type:'number'},
                            birthday_y:{ type: "number" },
                            birthday_d:{ type: "number" },
                            birthday_m:{ type: "number" },
                            photo_count:{ type: "number" },
                            start_wanted:{ type: "date" },
                            entry_date:{ type: "date" },
                            exit_date:{ type: "date" }
                        }
                    }
                },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#grid_man_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
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
                            contains: "<?php echo $Lang->contains; ?>",
                            startswith: "<?php echo $Lang->start; ?>",
                            eq: "<?php echo $Lang->equal; ?>",
                            neq: "<?php echo $Lang->not_equal; ?>"
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsMan<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    { command: { name:"aManFile", text: "F", click: showManFile<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editMan<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php } ?>
                    { field: "id", width: "100px", title: "Id" ,filterable:{
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
                    { field: "last_name", width: "120px", title: "<?php echo $Lang->last_name; ?>" },
                    { field: "first_name", width: "120px", title: "<?php echo $Lang->first_name; ?>"  },
                    { field: "middle_name", width: "120px", title: "<?php echo $Lang->middle_name; ?>"  },
                    { field: "birthday_d",width: "120px", title: "<?php echo $Lang->date_of_birth_d; ?>" ,filterable:{
                        extra: true,
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    }
                    },
                    { field: "birthday_m",width: "120px", title: "<?php echo $Lang->date_of_birth_m; ?>" ,filterable:{
                        extra: true,
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    }},
                    { field: "birthday_y",width: "100px", title: "<?php echo $Lang->date_of_birth_y; ?>" ,filterable:{
                        extra: true,
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    }},
                    { field: "man_auto",width: "300px", title: "<?php echo $Lang->last_name.' '.$Lang->first_name.' '.$Lang->middle_name; ?>"},
                    { field: "country_ate",width: "300px", title: "<?php echo $Lang->place_of_birth; ?>"},
                    { field: "region",width: "260px", title: "<?php echo $Lang->place_of_birth_area; ?>"},
                    { field: "locality",width: "360px", title: "<?php echo $Lang->place_of_birth_settlement; ?>"},
                    { field: "approximate_year",width: "260px", title: "<?php echo $Lang->approximate_year; ?>"},
                    { field: "passport", width: "175px", title: "<?php echo $Lang->passport_number; ?>"  },
                    { field: "gender",width: "70px", title: "<?php echo $Lang->gender; ?>"   },
                    { field: "nation", width: "180px",title: "<?php echo $Lang->nationality; ?>"   },
                    { field: "man_belongs_country", width: "145px", title: "<?php echo $Lang->citizenship; ?>" },
                    { field: "man_knows_language", width: "165px",title: "<?php echo $Lang->knowledge_of_languages; ?>" },
                    { field: "attention", width: "130px",title: "<?php echo $Lang->attention; ?>"   },
                    { field: "more_data",width: "310px", title: "<?php echo $Lang->additional_information_person; ?>"   },
                    { field: "religion",width: "180px", title: "<?php echo $Lang->worship; ?>"   },
                    { field: "occupation",width: "140px", title: "<?php echo $Lang->occupation; ?>"   },
                    { field: "country_search_man",width: "330px", title: "<?php echo $Lang->country_carrying_out_search; ?>"   },
                    { field: "operation_category", width: "280px",title: "<?php echo $Lang->operational_category_person; ?>" },

                    { field: "start_wanted", width: "195px",title: "<?php echo $Lang->declared_wanted_list_with; ?>",  format: "{0:dd-MM-yyyy}",
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
                    { field: "exit_date",width: "280px", title: "<?php echo $Lang->end_monitoring_start; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "education", width: "360px", title: "<?php echo $Lang->education; ?>" },
                    { field: "party", width: "145px",title: "<?php echo $Lang->party; ?>" },
                    { field: "nickname",width: "210px", title: "<?php echo $Lang->alias; ?>" },
                    { field: "opened_dou",width: "245px", title: "<?php echo $Lang->face_opened; ?>"   },
                    { field: "resource", width: "295px",title: "<?php echo $Lang->source_information; ?>"   },
                    { field: "photo_count",width: "80px", title: "<?php echo $Lang->short_photo; ?>" ,filterable:{
                        extra: true,
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    }},

                    { hidden: true, field: "bibliography_id" },
                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowMan<?php echo $_SESSION['counter']; ?> },  width: "90px" },
                    <?php }?>
                    <?php if($user_type == 1) { ?>
                    { command: { name:"aDelete", text: "<img src='<?php echo ROOT; ?>images/delete.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->delete; ?>' >", click: tableDelete<?php echo $_SESSION['counter']; ?> }, width: "90px" }
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
        <?php if(isset($b_id)) { ?>
            $('#addNewMan<?php echo $_SESSION['counter']; ?>').click(function(e){
                e.preventDefault();
                var title = $(this).attr('title');
                $.ajax({
                    url:'<?php echo ROOT; ?>add/man/<?php echo $b_id; if(isset($other_tb_name)){ echo "&other_tb=".$other_tb_name; } ; if(isset($old_counter)){ echo "&old_counter=".$old_counter; } ?>',
                    dataType : 'html',
                    success:function(data){
                        removeItem();
                        addItem(data,title);
                    }
                });
            });
        <?php } ?>

        });

        function showDetailsMan<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_man; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/manJoins/'+dataItem.id });
            wnd.center().open();
        }

        function showManFile<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_man; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>detail/man_file/'+dataItem.id });
            wnd.center().open();
        }

        function openWord<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>word/man/'+dataItem.id, '_blank' );
        }

        function editMan<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            if(dataItem.bibliography_id.length == 0){
                dataItem.bibliography_id = 'null';
            }
            $.ajax({
                url: '<?php echo ROOT?>add/man/'+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,'<?php echo $Lang->face; ?>'+' : '+dataItem.id);
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?>  ');
                }
            });
        }

        function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            var confDel = confirm('<?php echo $Lang->delete_entry;?>');
            if(confDel){
                $.ajax({
                    url: '<?php echo ROOT?>admin/optimization_man/',
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid_man_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            }
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
        function selectRowMan<?php echo $_SESSION['counter']; ?>(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'work_activity') { ?>
                    work_activity_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'signal_passes') { ?>
                    signal_man_passed_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'signal_check') { ?>
                    signal_signal_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'mia_summary') { ?>
                    mia_summary_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'criminal_case') { ?>
                    criminal_case_has_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'man') { ?>
                    man_knowen_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'objects_relation_man') { ?>
                    objects_relation_man_to_man<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'bibliography') { ?>
                    bibliographyHasMan<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php } ?>
            <?php } ?>
        }



    </script>
</div>