<div id="example" class="k-content">
    <?php if(isset($other_tb_name)){ ?><a class="closeButton"></a><?php }?>
    <div id="grid_action_open<?php echo $_SESSION['counter']; ?>"></div>

    <div class="details" style= ""></div>

    <script>
        var wnd;
        $(document).ready(function () {
            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url:"<?php echo ROOT;?>open/action/read",
                        dataType: "json",
                        type:'post'
                    },
                    parameterMap: function(data, type) {
                        if(typeof data.filter != 'undefined' && data.filter){
                            $.each(data.filter.filters,function(key,val){
                                if(typeof val.logic == 'undefined'){
                                    if(val.field == 'start_date' || val.field == 'end_date'){
                                        var a = new Date(val.value);
                                        data.filter.filters[key].value = a.toDateString();
                                    }
                                }else{
                                    $.each(val.filters,function(k,v){
                                        var a = new Date(v.value);
                                        data.filter.filters[key].filters[k].value = a.toDateString();
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
                            man_count: {type:'number'},
                            start_date:{ type: "date" },
                            end_date:{ type: "date" }
                        }
                    }
                },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#grid_action_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsAction<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editAction<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php } ?>
                    { field: "id",width: "100px", title: "Id" ,filterable:{
                        extra: false,
                        operators : {
                            number : {
                                eq: "<?php echo $Lang->equal; ?>",
                                neq: "<?php echo $Lang->not_equal; ?>"
                            }
                        },
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    } },
                    { field: "material_content", width: "330px", title: "<?php echo $Lang->content_materials_actions; ?>"  },
                    { field: "action_qualification",width: "355px", title: "<?php echo $Lang->qualification_fact; ?>" },
                    { field: "man_count",width: "80px", title: "<?php echo $Lang->face; ?>"  ,
                        filterable:{
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
                        }
                    },
                    { field: "start_date",width: "340px", title: "<?php echo $Lang->start_action_date; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "end_date",width: "335px", title: "<?php echo $Lang->end_action_date; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker,
                            extra: true
                        }
                    },
                    { field: "duration",width: "295px", title: "<?php echo $Lang->duration_action; ?>"  },
                    { field: "goal", width: "330px",title: "<?php echo $Lang->purpose_motive_reason; ?>"  },
                    { field: "terms",width: "300px", title: "<?php echo $Lang->terms_actions; ?>" },
                    { field: "aftermath",width: "380px", title: "<?php echo $Lang->ensuing_effects; ?>" },

                    { field: "source", width: "335px",title: "<?php echo $Lang->source_information_actions; ?>"   },
                    { field: "opened_dou",width: "155px", title: "<?php echo $Lang->opened_dou; ?>"   },
                    { hidden: true, field: "bibliography_id" },
                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowAction<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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

        $('#addNewAction').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'<?php echo ROOT; ?>add/action/'+tb_name,
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

        });

        function showDetailsAction<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_action; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/actionJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>word/action/'+dataItem.id, '_blank' );
        }

        function editAction<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            if(dataItem.bibliography_id.length == 0){
                dataItem.bibliography_id = 'null';
            }
            $.ajax({
                url: '<?php echo ROOT?>add/action/'+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,'<?php echo $Lang->action; ?>'+' : '+dataItem.id);
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }

        function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            var confDel = confirm('<?php echo $Lang->delete_entry;?>');
            if(confDel){
                $.ajax({
                    url: '<?php echo ROOT?>admin/optimization_action/',
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid_action_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
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
        function selectRowAction<?php echo $_SESSION['counter']; ?>(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'man') { ?>
                    man_has_action<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                    organization_has_action<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_action_has_event<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'event_has_action') { ?>
                    event_event_has_action<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'signal_check') { ?>
                    signal_action_passes_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_action<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'criminal_case') { ?>
                    criminal_case_action<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php } ?>
            <?php } ?>
        }



    </script>
</div>