<?php if(isset($other_tb_name)){ ?><a class="closeButton"></a><?php }?>

<?php if(isset($other_tb_name)){ ?> <div style="padding: 20px;"><input type="button" class="k-button" id="addNewWeapon<?php echo $_SESSION['counter']; ?>" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->weapon; ?>" value="<?php echo $Lang->createNew; ?>" /></div> <?php }?>
<div id="grid_weapon_open<?php echo $_SESSION['counter']; ?>" style="marign-top:100px"></div>

<div class="details"></div>

<script>

    var wnd;

    $(document).ready(function () {
        dataSource = new kendo.data.DataSource({
            transport: {
                read:  {
                    url:"<?php echo ROOT;?>open/weapon/read",
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
            pageSize: 20,
            schema: {
                data:'data',
                total:'count',
                model: {
                    id: "id",
                    fields: {
                        id: { editable: false, nullable: false ,type:'number'},
                        created_at:{ type: "date" } ,
                        count : { type : 'number' }
                    }
                }
            },
            pageSize: 20,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        });

        var grid = $("#grid_weapon_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
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
                { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsWeapon<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                <?php if($user_type != 3 ) { ?>
                { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editWeapon<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                <?php } ?>
                { field: "id", width: "100px",title: "Id" ,filterable:{
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
                { field: "reg_num", width: "170px",title: "<?php echo $Lang->account_number; ?>"  },
                { field: "count",width: "120px", title: "<?php echo $Lang->count; ?>"  ,
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
                { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                <?php if(isset($other_tb_name)){ ?>
                { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowWeapon<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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
//                    content:'<?php echo ROOT; ?>open/weaponJoins/'
                }).data("kendoWindow");

        $('#addNewWeapon<?php echo $_SESSION['counter']; ?>').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'<?php echo ROOT; ?>add/weapon/'+tb_name+'<?php if(isset($old_counter)){ echo "&old_counter=".$old_counter; }?>',
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

    });

    function showDetailsWeapon<?php echo $_SESSION['counter']; ?>(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        $('.k-window-title').html("<?php echo $Lang->ties_weapon; ?>"+dataItem.id);
        wnd.refresh({ url: '<?php echo ROOT; ?>open/weaponJoins/'+dataItem.id });
        wnd.center().open();
    }

    function openWord<?php echo $_SESSION['counter']; ?>(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        window.open('<?php echo ROOT; ?>word/weapon/'+dataItem.id, '_blank' );
    }

    function editWeapon<?php echo $_SESSION['counter']; ?>(e) {
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        $.ajax({
            url: '<?php echo ROOT?>add/weapon/edit/'+dataItem.id,
            dataType: 'html',
            success: function(data){
                addItem(data,'<?php echo $Lang->weapon; ?>'+' : '+dataItem.id);
            },
            faild: function(data){
                alert('<?php echo $Lang->err;?>');
            }
        });
    }

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
                    $("#grid_weapon_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });
        }
    }

    function selectRowWeapon<?php echo $_SESSION['counter']; ?>(e){
        e.preventDefault();
        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'man') { ?>
                man_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
            <?php }elseif($other_tb_name == 'organization') { ?>
                organization_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
            <?php }elseif($other_tb_name == 'event') { ?>
                event_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
            <?php }elseif($other_tb_name == 'action' ) { ?>
                action_has_weapon<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
            <?php } ?>
        <?php } ?>
    }

    function setDatePicker(element){
        element.kendoDatePicker({
            format: "dd-MM-yyyy"
        })
    }

</script>