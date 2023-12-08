<?php if(isset($other_tb_name)) { ?>
    <a class="closeButton"></a>
<?php }?>
<div id="example" class="k-content">
    <div id="grid_criminal_case_open<?php echo $_SESSION['counter']; ?>"></div>
   <div class="details" style= ""></div>
    <script>
     var wnd;
        $(document).ready(function () {

            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url:"<?php echo ROOT;?>open/criminal_case/read",
                        dataType: "json",
                        type:'post'
                    },
                    parameterMap: function(data, type) {
                        if(typeof data.filter != 'undefined' && data.filter){
                            $.each(data.filter.filters,function(key,val){
                                if(typeof val.logic == 'undefined'){
                                    if(val.field == 'created_at' || val.field == 'opened_date'){
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
                            opened_date : { type: 'date' },
                            created_at : { type: 'date' } ,
                            number : { type : 'number' },
                            man_count : { type: 'number' }
                        }
                    }
                },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#grid_criminal_case_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsCriminalCase<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editCriminalCase<?php echo $_SESSION['counter']; ?> }, width: "90px" },
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
                    { field: "number",width: "135px", title: "<?php echo $Lang->number_case; ?>"  ,
                        filterable:{
                            ui: function (element) {
                                element.kendoNumericTextBox({
                                    format: "n0"
                                });
                            }
                        }
                    },
                    { field: "opened_date",width: "350px", title: "<?php echo $Lang->criminal_proceedings_date; ?>",  format: "{0:dd-MM-yyyy }",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { field: "artical",width: "390px", title: "<?php echo $Lang->criminal_code; ?>"  },
                    { field: "opened_agency",width: "353px", title: "<?php echo $Lang->materials_management; ?>"  },
                    { field: "unit",width: "310px", title: "<?php echo $Lang->head_department; ?>"   },
                    { field: "subunit",width: "385px", title: "<?php echo $Lang->instituted_units; ?>"   },
                    { field: "worker",width: "310px", title: "<?php echo $Lang->name_operatives; ?>" },
                    { field: "worker_post",width: "270px", title: "<?php echo $Lang->worker_post; ?>" },
                    { field: "character",width: "300px", title: "<?php echo $Lang->nature_materials_paint; ?>" },
                    { field: "opened_dou",width: "210px", title: "<?php echo $Lang->initiated_dow; ?>"  },
                    { field: "man_count",width: "80px", title: "<?php echo $Lang->face; ?>"  ,
                        filterable:{
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
                        }
                    },
<!--                    { field: "created_at",width: "110px", title: "--><?php //echo $Lang->created_at; ?><!--",  format: "{0:dd-MM-yyyy}",-->
<!--                        filterable: {-->
<!--                            ui: setDatePicker ,-->
<!--                            extra: true-->
<!--                        }-->
<!--                    },-->
                    { hidden: true, field: "bibliography_id" },

                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowCriminalCase<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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

             $('#addNewCriminalCase<?php echo $_SESSION['counter']; ?>').click(function(e){
                 e.preventDefault();
                 var title = $(this).attr('title');
                 var tb_name = $(this).attr('fromTable');
                 $.ajax({
                     url:'<?php echo ROOT; ?>add/criminal_case/'+tb_name,
                     dataType : 'html',
                     success:function(data){
                         removeItem();
                         addItem(data,title);
                     }
                 });
             });

        });

     function showDetailsCriminalCase<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $('.k-window-title').html("<?php echo $Lang->ties_criminal_case; ?>"+dataItem.id);
         wnd.refresh({ url: '<?php echo ROOT; ?>open/criminalCaseJoins/'+dataItem.id });
         wnd.center().open();
     }

     function openWord<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         window.open('<?php echo ROOT; ?>word/criminal_case/'+dataItem.id, '_blank' );
     }

     function editCriminalCase<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $.ajax({
             url: '<?php echo ROOT?>add/criminal_case/'+dataItem.bibliography_id+'/'+dataItem.id,
             dataType: 'html',
             success: function(data){
                 if(typeof  bId == 'undefined'){
                     bId = dataItem.bibliography_id;
                 }
                 addItem(data,'<?php echo $Lang->criminal; ?>'+' : '+dataItem.id);
             },
             faild: function(data){
                 alert('<?php echo $Lang->err;?> ');
             }
         });
     }

     function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         var confDel = confirm('<?php echo $Lang->delete_entry;?>');
         if(confDel){
             $.ajax({
                 url: '<?php echo ROOT?>admin/optimization_criminal_case/',
                 type: 'post',
                 data: { 'id' : dataItem.id } ,
                 success: function(data){
                     $("#grid_criminal_case_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
                 },
                 faild: function(data){
                     alert('<?php echo $Lang->err;?> ');
                 }
             });
         }
     }

     function selectRowCriminalCase<?php echo $_SESSION['counter']; ?>(e){
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         <?php if (isset($other_tb_name)) { ?>
             <?php if($other_tb_name == 'man') { ?>
                 man_has_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'organization') { ?>
                 organization_has_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'event') { ?>
                 event_has_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'signal') { ?>
                 signal_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'action') { ?>
                 action_has_opened_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'criminal_case_extracted') { ?>
                 criminal_case_extracted_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'criminal_case_splited') { ?>
                 criminal_case_splited_criminal_case<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
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