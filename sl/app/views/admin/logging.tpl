<div id="example" class="k-content">
    <div id="grid"></div>
    <script>

        $(document).ready(function () {
                    dataSource = new kendo.data.DataSource({
                        transport: {
                            read:  {
                                url:"<?php echo ROOT;?>admin/logging/read",
                                dataType: "json",
                                type:'post'
                            },
                            parameterMap: function(data, type) {
                                if(typeof data.filter != 'undefined' && data.filter){
                                    $.each(data.filter.filters,function(key,val){
                                        if(typeof val.logic == 'undefined'){
                                            if(val.field == 'created_at'){
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
                        schema: {
                            data:'data',
                            total:'count',
                            model: {
                                id: "id",
                                fields: {
                                    id: { editable: false, nullable: false },
                                    created_at : { type: 'date' }
                                }
                            }
                        },
                        pageSize: 20,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true
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
                    { field: "username", title: "<?php echo $Lang->user_name;?>" },
                    { field: "first_name", title: "<?php echo $Lang->first_name;?>" },
                    { field: "last_name", title: "<?php echo $Lang->last_name;?>" },
                    { field: "user_type", title: "<?php echo $Lang->type;?>",filterable: { ui: userTypeFilter  } },
                    { field: "type", title: "<?php echo $Lang->operation;?>",filterable: { ui: typeFilter  } },
                    { field: "tb_name", title: "<?php echo $Lang->table_name;?>",filterable: { ui: tb_nameFilter  } },
                    { field: "tb_id", title: "ID 1" },
                    { field: "second_tb_id", title: "ID 2" },
                    { field: "created_at",width:"230px",  title: "<?php echo  $Lang->date_and_time_date; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    ],
                selectable: true,
//
            editable: "inline"


        }).data("kendoGrid");



        });

        function typeFilter(element) {
            element.kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                optionLabel: "...",
                dataSource: {
                    transport: {
                        read: {
                            dataType: "json",
                            url: "<?php echo ROOT;?>admin/logging/logging_type"
                        }
                    }
                }
            });
        }

        function tb_nameFilter(element) {
            element.kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                optionLabel: "...",
                dataSource: {
                    transport: {
                        read: {
                            dataType: "json",
                            url: "<?php echo ROOT;?>admin/logging/logging_tb_name"
                        }
                    }
                }
            });
        }

        function userTypeFilter(element) {
            element.kendoDropDownList({
                dataTextField: "text",
                dataValueField: "value",
                optionLabel: "...",
                dataSource: {
                    transport: {
                        read: {
                            dataType: "json",
                            url: "<?php echo ROOT;?>admin/logging/logging_user_type"
                        }
                    }
                }
            });
        }

        function setDatePicker(element){
            element.kendoDatePicker({
                format: "dd-MM-yyyy"
            })
        }

    </script>
</div>