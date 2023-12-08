<div id="example" class="k-content">
    <?php if(isset($other_tb_name)){ ?><a class="closeButton"></a><?php }?>
    <?php if(isset($other_tb_name)){ ?> <div style="padding: 20px;"><input type="button"  class="k-button" id="addNewCar<?php echo $_SESSION['counter']; ?>" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->car; ?>" value="<?php echo $Lang->createNew; ?>" /></div> <?php }?>
    <div id="grid_car_open<?php echo $_SESSION['counter']; ?>"></div>

   <div class="details" style= ""></div>

<script>
var wnd;
$(document).ready(function () {
    dataSource = new kendo.data.DataSource({
        transport: {
                read:  {
                    url:"<?php echo ROOT;?>open/car/read",
                    dataType:'json',
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
                        id: { editable: false, nullable: false,type:'number' },
                        created_at : { type: 'date' } ,
                        count : { type : 'number' }
                    }
                }
            },
        pageSize: 20,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true
    });

    var grid = $("#grid_car_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        navigatable: true,
        resizable: true,
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
            { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsCar<?php echo $_SESSION['counter']; ?> }, width: "90px" },
            <?php if($user_type != 3 ) { ?>
            { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editCar<?php echo $_SESSION['counter']; ?> }, width: "90px" },
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
            { field: "car_category", width: "120px",title: "<?php echo $Lang->car_cat; ?>"  },
            { field: "car_mark",width: "100px", title: "<?php echo $Lang->mark; ?>" },
            { field: "car_color",width: "260px", title: "<?php echo $Lang->color; ?>"  },
            { field: "number", width: "110px",title: "<?php echo $Lang->car_number; ?>"   },
            { field: "count", width: "120px",title: "<?php echo $Lang->count; ?>" ,
                filterable:{
                    ui: function (element) {
                        element.kendoNumericTextBox({
                            format: "n0"
                        });
                    }
                }
            },
            { field: "note", width: "230px",title: "<?php echo $Lang->additional_data; ?>"},
<!--            { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--",  format: "{0:dd-MM-yyyy}",-->
<!--                filterable: {-->
<!--                    ui: setDatePicker,-->
<!--                    extra: true-->
<!--                }-->
<!--            },-->
            { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
            <?php if(isset($other_tb_name)){ ?>
            { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowCar<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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

    $('#addNewCar<?php echo $_SESSION['counter']; ?>').click(function(e){
        e.preventDefault();
        var title = $(this).attr('title');
        var tb_name = $(this).attr('fromTable');
        $.ajax({
            url:'<?php echo ROOT; ?>add/car/'+tb_name+'<?php if(isset($old_counter)){ echo "&old_counter=".$old_counter; }?>',
            dataType : 'html',
            success:function(data){
                removeItem();
                addItem(data,title);
            }
        });
    });

});

        function showDetailsCar<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_car; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/carJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>word/car/'+dataItem.id, '_blank' );
        }

        function editCar<?php echo $_SESSION['counter']; ?>(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: '<?php echo ROOT?>add/car/edit/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,'<?php echo $Lang->car; ?>'+' : '+dataItem.id);
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
                    url: '<?php echo ROOT?>admin/optimization_car/',
                    type: 'post',
                    data: { 'id' : dataItem.id } ,
                    success: function(data){
                        $("#grid_car_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
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
        function selectRowCar<?php echo $_SESSION['counter']; ?>(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            <?php if (isset($other_tb_name)) { ?>
                <?php if($other_tb_name == 'man_use') { ?>
                    man_use_car<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'man') { ?>
                    man_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                    organization_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php }elseif($other_tb_name == 'action') { ?>
                    action_has_car<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
                <?php } ?>
            <?php } ?>
        }



</script>
</div>