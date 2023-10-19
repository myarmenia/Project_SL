<div id="example" class="k-content">
    <div id="grid"></div>

    <script>
        $(document).ready(function () {
            var dataSource = new kendo.data.DataSource({
                        transport: {
                            read:  {
                                url:"<?php echo ROOT;?>dictionary/agency/read",
                                dataType: "json"
                            },
                            update: {
                                url:"<?php echo ROOT;?>dictionary/agency/update",
                                type: 'post',
                                dataType: "json"
                            },
                            destroy: {
                                url:"<?php echo ROOT;?>dictionary/agency/destroy",
                                type: 'post',
                                dataType: "json"
                            },
                            create: {
                                url: "<?php echo ROOT;?>dictionary/agency/create",
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
                                    id: { editable: false, nullable: false , type:'number'},
                                    parentName: { defaultValue: { id: null, name: null} }
                                }
                            }
                        }
                    });

            $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                sortable: true,
                height: 430,
                resizable: true,
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
                        info: " <?php echo $Lang->search_as;?> ",
                        filter:'<?php echo $Lang->seek;?>',
                        clear:'<?php echo $Lang->clean;?>'
                    }
                },
                <?php if($user_type == 1) { ?>
                toolbar: [{name:'create', text:'<?php echo $Lang->createNew;?>'}],
                <?php } ?>
                columns: [
                    { field: "id", title:"Id", filterable: false },
                    { field: "name", title: "<?php echo $Lang->name;?>", format: "{0:c}", width: "600px" },
                    { field: "parentName", title: "<?php echo $Lang->name;?>", format: "{0:c}", width: "200px", editor: categoryDropDownEditor ,template: "#=parentName.name#" },
                    <?php if($user_type == 1) { ?>
                    { command: [{name:'edit',text:{ edit:'<?php echo $Lang->edit; ?>' , update:'<?php echo $Lang->update; ?>' , cancel:'<?php echo $Lang->cancel; ?>' } },
                                { name:'destroy' , text:'<?php echo $Lang->destroy; ?>'}] , title: "&nbsp;", width: "300px" }
                    <?php } ?>
                ],
                selectable: true,
                editable: "inline"

            });

            var dataAgencyParent = [
                    { 'id': 'NULL' , 'name' : ' ...'},
                <?php foreach($agencyParent as $val ) { ?>
                    { 'id' : '<?php echo $val['id']?>' , 'name' : '<?php echo $val['name']?>' },
                <?php } ?>
            ];

            function categoryDropDownEditor(container, options) {
                $('<input data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
                        .appendTo(container)
                        .kendoDropDownList({
                            autoBind: false,
                            dataSource: dataAgencyParent
                        });
            }
        });
    </script>
</div>