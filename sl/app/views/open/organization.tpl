<?php if(isset($other_tb_name)) { ?>
    <a class="closeButton"></a>
    <?php if ($other_tb_name == 'bibliography' || isset($old_counter) ){ ?>
        <div style="padding: 20px;">
            <input type="button" id="addNewOrganization<?php echo $_SESSION['counter']; ?>" class="k-button" fromTable="<?php echo $other_tb_name; ?>" title="<?php echo $Lang->organization; ?>" value="<?php echo $Lang->createNew; ?>" />
        </div>
    <?php } ?>
<?php }?>
<div id="example" class="k-content">
    <div id="grid_organization_open<?php echo $_SESSION['counter']; ?>"></div>
   <div class="details" style= ""></div>
    <script>
     var wnd;
        $(document).ready(function () {

            dataSource = new kendo.data.DataSource({
                transport: {
                    read:  {
                        url:"<?php echo ROOT;?>open/organization/read",
                        dataType: "json",
                        type:'post'
                    },
                    parameterMap: function(data, type) {
                        if(typeof data.filter != 'undefined' && data.filter){
                            $.each(data.filter.filters,function(key,val){
                                if(typeof val.logic == 'undefined'){
                                    if(val.field == 'created_at' || val.field == 'reg_date'){
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
                            reg_date : { type: 'date' },
                            created_at : { type: 'date' } ,
                            employers_count : { type : 'number' }
                        }
                    }
                },
                pageSize: 20,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true
            });

            var grid = $("#grid_organization_open<?php echo $_SESSION['counter']; ?>").kendoGrid({
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsOrganization<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if($user_type != 3 ) { ?>
                    { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editOrganization<?php echo $_SESSION['counter']; ?> }, width: "90px" },
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
                    { field: "org_name",width: "230px", title: "<?php echo $Lang->name_organization; ?>" },
                    { field: "country",width: "330px", title: "<?php echo $Lang->nation; ?>" },
                    { field: "reg_date",width: "315px", title: "<?php echo $Lang->date_formation; ?>",  format: "{0:dd-MM-yyyy}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: true
                        }
                    },
                    { field: "country_ate",width: "220px", title: "<?php echo $Lang->region_activity; ?>" },
                    { field: "category",width: "235px", title: "<?php echo $Lang->category_organization; ?>"  },
                    { field: "employers_count",width: "315px", title: "<?php echo $Lang->number_worker; ?>" ,
                        filterable:{
                            ui: function (element) {
                                element.kendoNumericTextBox({
                                    format: "n0"
                                });
                            }
                        }
                    },
                    { field: "attension", width: "128px",title: "<?php echo $Lang->attention; ?>" },
                    { field: "opened_dou",width: "300px", title: "<?php echo $Lang->organization_dow; ?>"   },
<!--                    { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--",  format: "{0:dd-MM-yyyy}",-->
<!--                        filterable: {-->
<!--                            ui: setDatePicker ,-->
<!--                            extra: true-->
<!--                        }-->
<!--                    },-->
                    { hidden: true, field: "bibliography_id" },

                    { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord<?php echo $_SESSION['counter']; ?> }, width: "90px" },
                    <?php if(isset($other_tb_name)){ ?>
                    { command: { name:"aAdd", text: "<img src='<?php echo ROOT; ?>images/add.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->add; ?>' >", click: selectRowOrganization<?php echo $_SESSION['counter']; ?> },  width: "90px" },
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
            <?php if(isset($b_id)) { ?>
                 $('#addNewOrganization<?php echo $_SESSION['counter']; ?>').click(function(e){
                     e.preventDefault();
                     var title = $(this).attr('title');
                     var tb_name = $(this).attr('fromTable');
                     $.ajax({
                         url:'<?php echo ROOT; ?>add/organization/<?php echo $b_id; if(isset($other_tb_name)){ echo "&other_tb=".$other_tb_name; } ; if(isset($old_counter)){ echo "&old_counter=".$old_counter; }; ?>',
                         dataType : 'html',
                         success:function(data){
                             removeItem();
                             addItem(data,title);
                         }
                     });
                 });
            <?php } ?>

        });

     function showDetailsOrganization<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         $('.k-window-title').html("<?php echo $Lang->ties_organization; ?>"+dataItem.id);
         wnd.refresh({ url: '<?php echo ROOT; ?>open/organizationJoins/'+dataItem.id });
         wnd.center().open();
     }

     function openWord<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         window.open('<?php echo ROOT; ?>word/organization/'+dataItem.id, '_blank' );
     }

     function editOrganization<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         if(!dataItem.bibliography_id){
             dataItem.bibliography_id = 'null';
         }
         $.ajax({
             url: '<?php echo ROOT?>add/organization/'+dataItem.bibliography_id+'/'+dataItem.id,
             dataType: 'html',
             success: function(data){
                 if(typeof  bId == 'undefined'){
                     bId = dataItem.bibliography_id;
                 }
                 addItem(data,'<?php echo $Lang->organization; ?>'+' : '+dataItem.id);
             },
             faild: function(data){
                 alert('<?php echo $Lang->err;?>  ');
             }
         });
     }

     function tableDelete<?php echo $_SESSION['counter']; ?>(e) {
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         var confDel = confirm('<?php echo $Lang->delete_entry;?>');
         if(confDel){
             $.ajax({
                 url: '<?php echo ROOT?>admin/optimization_organization/',
                 type: 'post',
                 data: { 'id' : dataItem.id } ,
                 success: function(data){
                     $("#grid_organization_open<?php echo $_SESSION['counter']; ?>").data("kendoGrid").dataSource.remove(dataItem);
                 },
                 faild: function(data){
                     alert('<?php echo $Lang->err;?> ');
                 }
             });
         }
     }

     function selectRowOrganization<?php echo $_SESSION['counter']; ?>(e){
         e.preventDefault();
         var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
         <?php if (isset($other_tb_name)) { ?>
             <?php if($other_tb_name == 'organization') { ?>
                 organization_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'objects_relation_org') { ?>
                 objects_relation_organization_to_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'event_has_organization') { ?>
                 event_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'event_organization') { ?>
                 event_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'signal_passes') { ?>
                 signal_organization_passes_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'signal_check') { ?>
                 signal_organization_checked_by_signal<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'mia_summary') { ?>
                 mia_summary_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'action') { ?>
                 action_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'criminal_case') { ?>
                 criminal_case_has_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'work_activity') { ?>
                 work_activity_organization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
             <?php }elseif($other_tb_name == 'bibliography') { ?>
                 bibliographyHasOrganization<?php if(isset($old_counter)){ echo $old_counter; }?>(dataItem.id);
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