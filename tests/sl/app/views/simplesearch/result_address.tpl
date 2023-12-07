<a class="closeButton"></a>
<div id="example" class="k-content">
    <div style="width: 70%; text-align: left">
        <?php
        $keyArray = array("country_ate_idName", "country_ate", "region_local", "region_idName", "locality_local", "locality_idName", "street_local", "street_idName", "region",
         "locality", "street", "track", "home_num", "housing_num", "apt_num", "content");
        $params = json_decode($_SESSION['search_params'], true);
        foreach ($params as $key=>$value ){
        if (gettype($value) == 'array' &&  in_array($key, $keyArray)) {
            foreach ($value as $val) {
                if ($val != '')
                echo $val . '; ' ;
            }
            } elseif ($value != '' && gettype($value) == 'string' &&  in_array($key, $keyArray)) {
            echo $value, '; ';
            }
        }
        ?>
    </div>
    <div style="text-align: right">
        <a class="k-button k-button-icontext k-grid-resetFilter" href="<?php echo ROOT ;?>simplesearch/simple_search_address?n=t"><?php echo $Lang->new_search?></a>
        <a class="k-button k-button-icontext k-grid-resetFilter" href="<?php echo ROOT ;?>simplesearch/simple_search_address?n=f"><?php echo $Lang->change_search?></a>
    </div>
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
                            id: { editable: false, nullable: false , type:'number'} ,
                            created_at : { type : 'date' }
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
                    { command: { name:"aJoin", text: "<img src='<?php echo ROOT; ?>images/view.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->view_ties; ?>' >", click: showDetailsAddress }, width: "90px" },
                <?php if($user_type != 3 ) { ?>
                { command: { name:"aEdit", text: "<img src='<?php echo ROOT; ?>images/edit.png' style='width: 30px;height: 30px;' title='<?php echo $Lang->edit; ?>' >" , click: editAddress }, width: "90px" },
            <?php } ?>
            { field: "id",width: "100px", title: "Id" ,
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
            } },
            { field: "country_ate", width: "140px",title: "<?php echo $Lang->country_ate; ?>" },
            { field: "region",width: "100px", title: "<?php echo $Lang->region; ?>" },
            { field: "locality",width: "200px", title: "<?php echo $Lang->locality; ?>"  },
            { field: "street",width: "100px",  title: "<?php echo $Lang->street; ?>"  },
            { field: "track", width: "290px", title: "<?php echo $Lang->track; ?>"   },
            { field: "home_num",width: "140px", title: "<?php echo $Lang->home_num; ?>"   },
            { field: "housing_num",width: "160px", title: "<?php echo $Lang->housing_num; ?>"   },
            { field: "apt_num", width: "175px",title: "<?php echo $Lang->apt_num; ?>"   },
            <!--                    { field: "created_at",width: "115px", title: "--><?php //echo $Lang->created_at; ?><!--",  format: "{0:dd-MM-yyyy}",-->
                <!--                        filterable: {-->
<!--                            ui: setDatePicker,-->
<!--                            extra: true-->
<!--                        }-->
                <!--                    },-->
            { command: { name:"aWord", text: "<img src='<?php echo ROOT; ?>images/word.gif' style='width: 30px;height: 30px;' title='<?php echo $Lang->word; ?>' >", click: openWord }, width: "90px" },
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

        $('#addNewAddress').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'<?php echo ROOT; ?>add/address/'+tb_name,
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
                    url: '<?php echo ROOT?>admin/optimization_address/',
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

        function showDetailsAddress(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_address; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/addressJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>word/address/'+dataItem.id, '_blank' );
        }

        function editAddress(e){
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $.ajax({
                url: '<?php echo ROOT?>add/address/edit/'+dataItem.id,
                dataType: 'html',
                success: function(data){
                    addItem(data,'<?php echo $Lang->address; ?>');
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?>');
                }
            });
        }

        function selectRowAddress(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'man') { ?>
                    man_has_address(dataItem.id);
                <?php }elseif($other_tb_name == 'organization') { ?>
                    organization_has_address(dataItem.id);
                <?php }elseif($other_tb_name == 'organization_address') { ?>
                    organization_address(dataItem.id);
                <?php }elseif($other_tb_name == 'event_address') { ?>
                    event_address(dataItem.id);
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