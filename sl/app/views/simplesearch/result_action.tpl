<a class="closeButton"></a>
<div id="example" class="k-content">

    <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("material_content", "action_qualification_idName", "duration_idName", "goal_idName", "terms_idName", "aftermath_idName", "source", "opened_dou", "action_qualification",
         "duration_name", "goal_name", "terms_name", "aftermath_name", "start_date", "end_date", "content");
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
        <a class="k-button k-button-icontext k-grid-resetFilter" href="<?php echo ROOT ;?>simplesearch/simple_search_action?n=t"><?php echo $Lang->new_search?></a>
        <a class="k-button k-button-icontext k-grid-resetFilter" href="<?php echo ROOT ;?>simplesearch/simple_search_action?n=f"><?php echo $Lang->change_search?></a>
    </div>
    <div id="grid"></div>

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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsAction }, width: "90px" },
                <?php if($user_type != 3 ) { ?>
                { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editAction }, width: "90px" },
            <?php } ?>
            { field: "id",width: "100px", title: "Id" ,
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
            { field: "material_content", width: "330px",title: "<?php echo $Lang->content_materials_actions; ?>"  },
            { field: "action_qualification",width: "355px",  title: "<?php echo $Lang->qualification_fact; ?>" },
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
            { field: "action_goal",width: "330px", title: "<?php echo $Lang->purpose_motive_reason; ?>"  },
            { field: "terms", width: "300px", title: "<?php echo $Lang->terms_actions; ?>" },
            { field: "aftermath",width: "380px", title: "<?php echo $Lang->ensuing_effects; ?>" },

            { field: "source", width: "335px", title: "<?php echo $Lang->source_information_actions; ?>"   },
            { field: "opened_dou",width: "155px", title: "<?php echo $Lang->opened_dou; ?>"   },
            { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord }, width: "90px" } ,
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

        function showDetailsAction(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_action; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/actionJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>word/action/'+dataItem.id, '_blank' );
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
                url: '<?php echo ROOT?>add/action/'+dataItem.bibliography_id+'/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    if(typeof  bId == 'undefined'){
                        bId = dataItem.bibliography_id;
                    }
                    addItem(data,'<?php echo $Lang->action; ?>');
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
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
            var confDel = confirm('<?php echo $Lang->delete_entry;?>');
            if(confDel){
                $.ajax({
                    url: '<?php echo ROOT?>admin/optimization_action/',
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid").data("kendoGrid").dataSource.remove(dataItem);
                    },
                    faild: function(data){
                        alert('<?php echo $Lang->err;?> ');
                    }
                });
            }
        }


    </script>
</div>