<div id="example" class="k-content">
    <div id="grid"></div>

    <script>
        $(document).ready(function () {
            var dataSource = new kendo.data.DataSource({
                        transport: {
                            read:  {
                                url:"<?php echo ROOT;?>dictionary/resource/read",
                                dataType: "json"
                            },
                            update: {
                                url:"<?php echo ROOT;?>dictionary/resource/update",
                                type: 'post',
                                dataType: "json"
                            },
                            destroy: {
                                url:"<?php echo ROOT;?>dictionary/resource/destroy",
                                type: 'post',
                                dataType: "json"
                            },
                            create: {
                                url: "<?php echo ROOT;?>dictionary/resource/create",
                                type: 'post',
                                dataType: "json"
                            },
                            parameterMap: function(options, operation) {
                                if (operation !== "read" && options.models) {
                                    return {models: kendo.stringify(options.models)};
                                }
                            }
                        },
                        batch: true,
                        pageSize: 20,
                        schema: {
                            model: {
                                id: "id",
                                fields: {
                                    id: { editable: false, nullable: false , type:'number'}
                                }
                            }
                        }
                    });

            $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                sortable: true,
                height: 430,
                scrollable: true,
                dataBound: dataBound,
                toolbar: [{ name:'resetFilter' ,text: "<?php echo $Lang->clean_all; ?>" }] ,
                filterable: {
                    extra: false,
                    operators: {
                        string: {
                            startswith: "<?php echo $Lang->start;?>",
                            contains: "<?php echo $Lang->contains;?>"
                        }
                    },
                    messages: {
                        info: "<?php echo $Lang->search_as;?>",
                        filter:'<?php echo $Lang->seek;?>',
                        clear:'<?php echo $Lang->clean;?>'
                    }
                },
                <?php if($user_type == 1) { ?>
                toolbar: [{name:'create', text:'<?php echo $Lang->createNew;?>'}],
                <?php } ?>
                columns: [
                    { field: "id", title:"Id", filterable: false },
                    { field: "name", title: "<?php echo $Lang->name;?>", format: "{0:c}", width: "800px" },

                    <?php if($user_type == 1) { ?>
                    { command: [{name:'edit',text:{ edit:'<?php echo $Lang->edit; ?>' , update:'<?php echo $Lang->update; ?>' , cancel:'<?php echo $Lang->cancel; ?>' } },
                                { name:'destroy' , text:'<?php echo $Lang->destroy; ?>'}] , title: "&nbsp;", width: "300px" }
                    <?php } ?>
                ],
                selectable: true,
                editable: "inline"

            });
        });
    </script>
</div>