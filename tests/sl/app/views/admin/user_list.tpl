<div id="example" class="k-content">
    <div style="padding: 20px;"><input type="button" id="addNewMan" class="k-button" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->face; ?>" value="<?php echo $Lang->createNew; ?>" onclick="addUser();" /></div>
    <div id="grid"></div>
    <script>

        $(document).ready(function () {
            var crudServiceBaseUrl = "http://demos.kendoui.com/service",
                    dataSource = new kendo.data.DataSource({
                        transport: {
                            read:  {
                                url:"<?php echo ROOT;?>admin/user_list/read",
                                dataType: "json"
                            },
                            destroy: {
                                url:"<?php echo ROOT;?>admin/user_list/destroy",
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
                                    id: { editable: false, nullable: false , type:'number' }
                                }
                            }
                        }
                    });





            var grid = $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                sortable: true,
                resizable: true,
                scrollable: true,
                dataBound: dataBound,
                toolbar: [{ name:'resetFilter' ,text: "<?php echo $Lang->clean_all; ?>" }] ,
                height: 430,
                filterable: {
                    extra: false,
                    operators: {
                        string: {
                            startswith: "<?php echo $Lang->start;?>",
                            contains: "<?php echo $Lang->contains;?>"
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
                        info: " <?php echo $Lang->search_as;?> ",
                        filter:'<?php echo $Lang->seek;?>',
                        clear:'<?php echo $Lang->clean;?>'
                    }
                },
                columns: [
                    { field: "id", title:"Id", filterable: true },
                    { field: "username", title: "<?php echo $Lang->user_name;?>" },
                    { field: "first_name", title: "<?php echo $Lang->first_name;?>" },
                    { field: "last_name", title: "<?php echo $Lang->last_name;?>" },
                    { field: "user_type", title: "<?php echo $Lang->type;?>" },

                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editUser }, width: "90px" },
                    { command: { name:"delete", text: "<img src='<?php echo ROOT; ?>images/delete.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->delete; ?>' >" }, width: "90px" }

                ],
                selectable: true,


//
            editable: "inline"

        }).data("kendoGrid");

        });


        function editUser(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: '<?php echo ROOT?>admin/edit/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,'<?php echo $Lang->user_edit; ?>');
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }

        function addUser() {
            $.ajax({
                url:'<?php echo ROOT; ?>admin/add/',
                dataType : 'html',
                success:function(data){
                    addItem(data,'<?php echo $Lang->add_user; ?>');
//                    removeItem();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    </script>
</div>