<?php if(isset($other_tb_name)) { ?>
    <a class="closeButton"></a>
    <div style="padding: 20px;">
        <input type="button" id="addNewControl<?php echo $_SESSION['counter']; ?>"  class="k-button" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->control; ?>" value="<?php echo $Lang->createNew; ?>" />
    </div>
<?php }?>
<div id="example" class="k-content">
    <div id="grid_control_open<?php echo $_SESSION['counter']; ?>"></div>
   <div class="details" style= ""></div>
    <script>
     var wnd;
        $(document).ready(function () {

            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url:"<?php echo ROOT;?>open/control/read",
                        dataType: "json",
                        type:'post'
                    },
                    parameterMap: function(data, type) {
                        if(typeof data.filter != 'undefined' && data.filter){
                            $.each(data.filter.filters,function(key,val){
                                if(typeof val.logic == 'undefined'){
                                    if(val.field == 'creation_date' || val.field == 'reg_date' || val.field == 'resolution_date'){
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
                            id: { editable: false, nullable: false,type:'number' },
                            creation_date : { type: 'date' },
                            reg_date : { type: 'date' },
                            resolution_date : { type: 'date' }
                        }
                    }
                },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#grid_control_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsControl<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editControl<?php echo $_SESSION['counter']; ?> }, width: "90px" },
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
                    { field: "unit",width: "165px", title: "<?php echo $Lang->unit; ?>"  },
                    { field: "doc_category",width: "220px", title: "<?php echo $Lang->document_category; ?>" },
                    { field: "creation_date",width: "285px", title: "<?php echo $Lang->document_date; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { field: "reg_num",width: "185px", title: "<?php echo $Lang->reg_document; ?>"  },
                    { field: "reg_date",width: "195px", title: "<?php echo $Lang->date_reg; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { field: "snb_director", width: "220px",title: "<?php echo $Lang->director; ?>"  },
                    { field: "snb_subdirector",width: "250px", title: "<?php echo $Lang->deputy_director; ?>" },
                    { field: "resolution_date",width: "170px", title: "<?php echo $Lang->date_resolution; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { field: "resolution",width: "130px", title: "<?php echo $Lang->resolution; ?>" },
                    { field: "act_unit",width: "380px", title: "<?php echo $Lang->department_performer; ?>" },
                    { field: "actor_name",width: "225px", title: "<?php echo $Lang->actor_name; ?>" },
                    { field: "sub_act_unit",width: "320px", title: "<?php echo $Lang->department_coauthors; ?>" },
                    { field: "sub_actor_name",width: "250px", title: "<?php echo $Lang->actor_name; ?>" },
                    { field: "result", width: "225px",title: "<?php echo $Lang->result_execution; ?>" },

                    { hidden: true, field: "bibliography_id" },

                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowControl<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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

             $('#addNewControl<?php echo $_SESSION['counter']; ?>').click(function(e){
                 e.preventDefault();
                 var title = $(this).attr('title');
                 var tb_name = $(this).attr('fromTable');
                 $.ajax({
                     url:'<?php echo ROOT; ?>add/control/'+tb_name,
                     dataType : 'html',
                     success:function(data){
                         removeItem();
                         addItem(data,title);
                     }
                 });
             });

        });

     function showDetailsControl<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $('.k-window-title').html("<?php echo $Lang->ties_control; ?>"+dataItem.id);
         wnd.refresh({ url: '<?php echo ROOT; ?>open/controlJoins/'+dataItem.id });
         wnd.center().open();
     }

     function openWord<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         window.open('<?php echo ROOT; ?>word/control/'+dataItem.id, '_blank' );
     }

     function editControl<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $.ajax({
             url: '<?php echo ROOT?>add/control/'+dataItem.bibliography_id+'/'+dataItem.id,
             dataType: 'html',
             success: function(data){
                 if(typeof  bId == 'undefined'){
                     bId = dataItem.bibliography_id;
                 }
                 addItem(data,'<?php echo $Lang->control; ?>'+' : '+dataItem.id);
             },
             faild: function(data){
                 alert('<?php echo $Lang->err; ?> ');
             }
         });
     }

     function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         var confDel = confirm('<?php echo $Lang->delete_entry;?>');
         if(confDel){
             $.ajax({
                 url: '<?php echo ROOT?>admin/optimization_control/',
                 type: 'post',
                 data: { 'id' : dataItem.id } ,
                 success: function(data){
                     $("#grid_control_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
                 },
                 faild: function(data){
                     alert('<?php echo $Lang->err;?> ');
                 }
             });
         }
     }

     function selectRowControl<?php echo $_SESSION['counter']; ?>(e){
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