<?php if(isset($other_tb_name)) { ?>
    <a class="closeButton"></a>
    <div style="padding: 20px;">
        <input type="button" id="addNewPhone<?php echo $_SESSION['counter']; ?>" class="k-button" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->telephone; ?>" value="<?php echo $Lang->createNew; ?>" />
    </div>
<?php }?>
<div id="example" class="k-content">
    <div id="grid_phone_open<?php echo $_SESSION['counter']; ?>"></div>
   <div class="details" style= ""></div>
    <script>
     var wnd;
        $(document).ready(function () {

            dataSource = new kendo.data.DataSource({
                transport: {
                        read:  {
                            url:"<?php echo ROOT;?>open/phone/read",
                            dataType: "json",
                            type:'post'
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
                                id: { editable: false, nullable: false,type:'number' }

                            }
                        }
                    },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#grid_phone_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                resizable: true,
                sortable: true,
                navigatable: true,
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsPhone<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editPhone<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php } ?>
                    { field: "id", title: "Id" ,filterable:{
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
                    }},

                    { field: "number", title: "<?php echo $Lang->phone_number; ?>" },
                    { field: "character", title: "<?php echo $Lang->nature_character; ?>" },
                    { field: "more_data", title: "<?php echo $Lang->additional_data; ?>" },

                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowPhone<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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

             $('#addNewPhone<?php echo $_SESSION['counter']; ?>').click(function(e){
                 e.preventDefault();
                 var title = $(this).attr('title');
                 var tb_name = $(this).attr('fromTable');
                 $.ajax({
                     url:'<?php echo ROOT; ?>add/phone/'+tb_name,
                     dataType : 'html',
                     success:function(data){
                         removeItem();
                         addItem(data,title);
                     }
                 });
             });

        });

     function showDetailsPhone<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $('.k-window-title').html("<?php echo $Lang->ties_phone; ?>"+dataItem.id);
         wnd.refresh({ url: '<?php echo ROOT; ?>open/phoneJoins/'+dataItem.id });
         wnd.center().open();
     }

     function openWord<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         window.open('<?php echo ROOT; ?>word/phone/'+dataItem.id, '_blank' );
     }

     function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         var confDel = confirm('<?php echo $Lang->delete_entry;?>');
         if(confDel){
             $.ajax({
                 url: '<?php echo ROOT?>admin/optimization_phone/',
                 type: 'post',
                 data: { 'id' : dataItem.id } ,
                 success: function(data){
                     $("#grid_phone_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
                 },
                 faild: function(data){
                     alert('<?php echo $Lang->err;?> ');
                 }
             });
         }
     }

     function selectRowPhone<?php echo $_SESSION['counter']; ?>(e){
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

     function editPhone<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $.ajax({
             url: '<?php echo ROOT?>add/phone/edit/'+dataItem.id,
             dataType: 'html',
             success: function(data){
                 if(typeof  bId == 'undefined'){
                     bId = 'null';
                 }
                 addItem(data,'<?php echo $Lang->telephone_number; ?> id:'+dataItem.id );
             },
             faild: function(data){
                 alert('<?php echo $Lang->err;?> ');
             }
         });
     }



    </script>
</div>