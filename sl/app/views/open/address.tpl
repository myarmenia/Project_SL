<?php if(isset($other_tb_name)) { ?>
    <a class="closeButton"></a>
    <div style="padding: 20px;">
        <input type="button"  class="k-button" id="<?php echo $_SESSION['counter']; ?>addNewAddress" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->address; ?>" value="<?php echo $Lang->createNew; ?>" />
    </div>
<?php }?>
<div id="<?php echo $_SESSION['counter']; ?>example" class="k-content">
    <div id="<?php echo $_SESSION['counter']; ?>grid_address_open"></div>
   <div class="details" style= ""></div>
    <script>
     var wnd;
        $(document).ready(function () {

            dataSource = new kendo.data.DataSource({
                transport: {
                        read:  {
                            url:"<?php echo ROOT;?>open/address/read",
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
                                id: { editable: false, nullable: false ,type:'number'} ,
                                created_at : { type : 'date' }
                            }
                        }
                    },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#<?php echo $_SESSION['counter']; ?>grid_address_open").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                resizable: true,
                navigatable: true,
                sortable: true,
                dataBound: dataBound,
                toolbar: [{ name:'resetFilter' ,text: "<?php echo $Lang->clean_all; ?>" }] ,
                height: 430,
                scrollable: true,
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsAddress<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editAddress<?php echo $_SESSION['counter']; ?> }, width: "90px" },
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
                    { field: "country_ate",width: "140px", title: "<?php echo $Lang->country_ate; ?>" },
                    { field: "region",width: "100px", title: "<?php echo $Lang->region; ?>" },
                    { field: "locality",width: "200px", title: "<?php echo $Lang->locality; ?>"  },
                    { field: "street", width: "100px",title: "<?php echo $Lang->street; ?>"  },
                    { field: "track",width: "290px", title: "<?php echo $Lang->track; ?>"   },
                    { field: "home_num",width: "140px", title: "<?php echo $Lang->home_num; ?>"   },
                    { field: "housing_num",width: "160px", title: "<?php echo $Lang->housing_num; ?>"   },
                    { field: "apt_num",width: "175px", title: "<?php echo $Lang->apt_num; ?>"   },
<!--                    { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--",  format: "{0:dd-MM-yyyy}",-->
<!--                        filterable: {-->
<!--                            ui: setDatePicker,-->
<!--                            extra: true-->
<!--                        }-->
<!--                    },-->
                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowAddress<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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

             $('#<?php echo $_SESSION['counter']; ?>addNewAddress').click(function(e){
                 e.preventDefault();
                 var title = $(this).attr('title');
                 var tb_name = $(this).attr('fromTable');
                 $.ajax({
                     url:'<?php echo ROOT; ?>add/address/'+tb_name+'<?php if(isset($old_counter)){ echo "&old_counter=".$old_counter; }?>',
                     dataType : 'html',
                     success:function(data){
                         removeItem();
                         addItem(data,title);
                     }
                 });
             });

        });

     function showDetailsAddress<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $('.k-window-title').html("<?php echo $Lang->ties_address; ?>"+dataItem.id);
         wnd.refresh({ url: '<?php echo ROOT; ?>open/addressJoins/'+dataItem.id });
         wnd.center().open();
     }

     function openWord<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         window.open('<?php echo ROOT; ?>word/address/'+dataItem.id, '_blank' );
     }

     function editAddress<?php echo $_SESSION['counter']; ?>(e){
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $.ajax({
             url: '<?php echo ROOT?>add/address/edit/'+dataItem.id,
             dataType: 'html',
             success: function(data){
                 addItem(data,'<?php echo $Lang->address; ?>'+' : '+dataItem.id);
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
                 url: '<?php echo ROOT?>admin/optimization_address/',
                 type: 'post',
                 data: { 'id' : dataItem.id } ,
                 success: function(data){
                     $("#<?php echo $_SESSION['counter']; ?>grid_address_open").data("kendoGrid").dataSource.remove(dataItem);
                 },
                 faild: function(data){
                     alert('<?php echo $Lang->err;?> ');
                 }
             });
         }
     }

     function selectRowAddress<?php echo $_SESSION['counter']; ?>(e){
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         <?php if (isset($other_tb_name)) { ?>
             <?php if($other_tb_name == 'man') { ?>
                 man_has_address<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'organization') { ?>
                 organization_has_address<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'organization_address') { ?>
                 organization_address<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'event_address') { ?>
                 event_address<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'action') { ?>
                 action_has_address<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
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