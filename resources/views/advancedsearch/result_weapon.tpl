<a class="closeButton"></a>
<div id="example" class="k-content">

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
                        id: { editable: false, nullable: false, type:'number' },
                        created_at:{ type: "date" },
                        count : { type : 'number' }
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
                { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsWeapon }, width: "90px" },
                <?php if($user_type != 3 ) { ?>
                { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editWeapon }, width: "90px" },
                <?php } ?>
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
                { field: "category",width: "100px", title: "<?php echo $Lang->weapon_cat; ?>"  },
                { field: "view",width: "100px", title: "<?php echo $Lang->view; ?>" },
                { field: "type",width: "100px", title: "<?php echo $Lang->type; ?>"  },
                { field: "model",width: "100px", title: "<?php echo $Lang->mark; ?>" },
                { field: "reg_num",width: "170px", title: "<?php echo $Lang->account_number; ?>"  },

                { field: "count", width: "120px",title: "<?php echo $Lang->count; ?>" ,
                    filterable:{
                        ui: function (element) {
                            element.kendoNumericTextBox({
                                format: "n0"
                            });
                        }
                    }
                },
<!--                { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--" , format: "{0:dd-MM-yyyy}",-->
<!--                    filterable: {-->
<!--                        ui: setDatePicker,-->
<!--                        extra: true-->
<!--                    }-->
<!--                },-->
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
//                    content:'<?php echo ROOT; ?>open/weaponJoins/'
            }).data("kendoWindow");

    $('#addNewWeapon').click(function(e){
        e.preventDefault();
        var title = $(this).attr('title');
        var tb_name = $(this).attr('fromTable');
        $.ajax({
            url:'<?php echo ROOT; ?>add/weapon/'+tb_name,
            dataType : 'html',
            success:function(data){
                removeItem();
                addItem(data,title);
            }
        });
    });

    });

    function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        var confDel = confirm('<?php echo $Lang->delete_entry;?>');
        if(confDel){
            $.ajax({
                url: '<?php echo ROOT?>admin/optimization_weapon/',
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

    function showDetailsWeapon(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        $('.k-window-title').html("<?php echo $Lang->ties_weapon; ?>"+dataItem.id);
        wnd.refresh({ url: '<?php echo ROOT; ?>open/weaponJoins/'+dataItem.id });
        wnd.center().open();
    }

    function openWord(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        window.open('<?php echo ROOT; ?>word/weapon_with_joins/'+dataItem.id, '_blank' );
    }

    function editWeapon(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        $.ajax({
            url: '<?php echo ROOT?>add/weapon/edit/'+dataItem.id,
            dataType: 'html',
            success: function(data){
                addItem(data,'<?php echo $Lang->weapon; ?>');
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?>');
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