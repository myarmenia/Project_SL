<a class="closeButton"></a>
<div id="example" class="k-content">
    <table style="100%">
        <tr>
            <td style="width: 30%; text-align: left">
                <?php echo($params); ?>
            </td>
            <td style="width: 50%; text-align: right">
                <form id="search" action="<?php echo ROOT; ?>templatesearch/result_bibliography" method="post">

                    <div class="forForm">
                        <label for="fileSearch"><?php echo $Lang->file_in_search; ?></label>
                        <input type="text" name="content" id="fileSearch"/>

                        <input type="hidden" name="file_ids" value="<?php echo $file_ids ?>" />
                        <input type="hidden" name="params" value="<?php echo $params ?>" />
                        <input type="submit" value="<?php echo $Lang->search; ?>" />
                    </div>
                    <div style="clear: both;"></div>
                </form>
            </td>
        </tr>
    </table>
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
                            id: { editable: false, nullable: false , type: 'number'},
                            related_year : { type: 'number' },
                            file_count : { type: 'number' },
                            created_at : { type: 'date' },
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
                selectable: true,
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsBibliography }, width: "90px" },
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
                    { field: "user_name",width:"330px", title: "<?php echo $Lang->created_user; ?>" },
                    { field: "created_at",width:"230px",  title: "<?php echo  $Lang->date_and_time_date; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { hidden: true, field: "file_id" },
                    { field: "from_agency_name",width: "357px", title: "<?php echo $Lang->organ; ?>" },
                    { field: "access_level",width: "175px", title: "<?php echo $Lang->access_level; ?>"  },
                    { field: "reg_number",width: "125px", title: "<?php echo $Lang->reg_number; ?>"   },
                    { field: "reg_date",width: "115px", title: "<?php echo $Lang->reg_date; ?>", format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { field: "worker_name",width: "210px", title: "<?php echo $Lang->worker_name; ?>"   },
                    { field: "user",width: "360px", title: "<?php echo $Lang->worker_take_doc; ?>" },

                    { field: "source_agency_name",width: "375px", title: "<?php echo $Lang->source_agency; ?>"  },
                    { field: "source_address",width: "345px", title: "<?php echo $Lang->source_address; ?>"  },

                    { field: "short_desc",width: "305px", title: "<?php echo $Lang->short_desc; ?>"  },
                    { field: "related_year",width: "260px", title: "<?php echo $Lang->related_year; ?>" ,
                        filterable:{
                            ui: function (element) {
                                element.kendoNumericTextBox({
                                    format: "n0"
                                });
                            }
                        }
                    },
                    { field: "source",width: "230px", title: "<?php echo $Lang->source_inf; ?>" },
                    { field: "file_count", width:"80px",  title: "<?php echo $Lang->file; ?>"  },
                    { field: "video", width:"80px",  title: "<?php echo $Lang->short_video; ?>"  ,
                        filterable:{
                            ui: function (element) {
                                element.kendoNumericTextBox({
                                    format: "n0"
                                });
                            }
                        }
                    },
                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord }, width: "90px" }

                ]
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

            $('#addNewBibliography').click(function(e){
                e.preventDefault();
                var title = $(this).attr('title');
                var tb_name = $(this).attr('fromTable');
                $.ajax({
                    url:'<?php echo ROOT; ?>add/bibliography/'+tb_name,
                    dataType : 'html',
                    success:function(data){
                        removeItem();
                        addItem(data,title);
                    }
                });
            });

        });

        function showDetailsBibliography(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_bibliography; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/bibliographyJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>bibliography/downloadFile/'+dataItem.file_id, '_blank' );
        }

        function editBibliography(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: '<?php echo ROOT?>add/bibliography/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,'<?php echo $Lang->bibliography; ?>');
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
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