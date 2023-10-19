<a class="closeButton"></a>
<div id="example" class="k-content">

    <div id="grid"></div>
    <div class="details" style= ""></div>
    <script>
        var wnd;
        $(document).ready(function () {

            var data = jQuery.parseJSON('<?php echo $data;?>');

            dataSource = new kendo.data.DataSource({
                type:'odata',
                data:data,
                batch: true,
                pageSize: 20,
                schema: {
                    model: {
                        id: "id",
                        fields: {
                            id: { editable: false, nullable: false },
                            birthday:{ type: "date" },
                            start_wonted:{ type: "date" },
                            entry_date:{ type: "date" },
                            exit_date:{ type: "date" }
                        }
                    }
                }
            });

            var grid = $("#grid").kendoGrid({
                dataSource: dataSource,
                pageable: true,
                resizable: true,
                sortable: true,
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
                    { field: "id", title: "Id" ,filterable:false },
                    { field: "first_name", title: "<?php echo $Lang->first_name; ?>"  },
                    { field: "last_name", title: "<?php echo $Lang->last_name; ?>" },
                    { field: "middle_name", title: "<?php echo $Lang->middle_name; ?>"  },
                    { field: "passport", title: "<?php echo $Lang->passport_number; ?>"  },
                    { field: "gender", title: "<?php echo $Lang->gender; ?>"  },
                    { field: "country", title: "<?php echo $Lang->citizenship; ?>" },
                    { field: "country_ate", title: "<?php echo $Lang->place_of_birth; ?>" },
                    { field: "locality_id", title: "<?php echo $Lang->place_of_birth_settlement_local; ?>" },
                    { field: "region_id", title: "<?php echo $Lang->place_of_birth_area_local; ?>" },
                    { field: "education", title: "<?php echo $Lang->education; ?>" },
                    { field: "language", title: "<?php echo $Lang->knowledge_of_languages; ?>" },
                    { field: "party", title: "<?php echo $Lang->party; ?>" },
                    { field: "citizenship", title: "<?php echo $Lang->citizenship; ?>" },
                    { field: "country", title: "<?php echo $Lang->country_carrying_out_search; ?>" },
                    { field: "nation", title: "<?php echo $Lang->nationality; ?>" },
                    { field: "nickname", title: "<?php echo $Lang->alias; ?>" },
                    { field: "operation_category", title: "<?php echo $Lang->operational_category_person; ?>" },

                    { field: "birthday", title: "<?php echo $Lang->date_of_birth; ?>" , format: "{0:yyyy-MM-dd HH:mm}",
                        filterable: {
                            ui: setDateTimeP,
                            extra: true
                        }
                    },
                    { field: "answer", title: "<?php echo $Lang->answer; ?>"},
                    { field: "resource", title: "<?php echo $Lang->source_information; ?>"},
                    { field: "approximate_year", title: "<?php echo $Lang->approximate_year; ?>"},


                    { field: "start_wanted", title: "<?php echo $Lang->declared_wanted_list_with; ?>",  format: "{0:yyyy-MM-dd HH:mm}",
                        filterable: {
                            ui: setDateTimeP,
                            extra: true
                        }
                    },
                    { field: "entry_date", title: "<?php echo $Lang->home_monitoring_start; ?>",  format: "{0:yyyy-MM-dd HH:mm}",
                        filterable: {
                            ui: setDateTimeP,
                            extra: true
                        }
                    },
                    { field: "exit_date", title: "<?php echo $Lang->end_monitoring_start; ?>",  format: "{0:yyyy-MM-dd HH:mm}",
                        filterable: {
                            ui: setDateTimeP,
                            extra: true
                        }
                    },
                    { field: "attention", title: "<?php echo $Lang->attention; ?>"   },
                    { field: "more_data", title: "<?php echo $Lang->additional_information_person; ?>"   },
                    { field: "occupation", title: "<?php echo $Lang->occupation; ?>"   },
                    { field: "opened_dou", title: "<?php echo $Lang->face_opened; ?>"   },

                    { command: { text: "<?php echo $Lang->view_ties; ?>", click: showDetailsMan }, title: " ", width: "140px" },
                    { command: { text: "<?php echo $Lang->edit; ?>"}, title: "<?php echo $Lang->edit; ?>", width: "160px" },
                    { command: { text: "WORD", click: openWord }, title: "WORD", width: "100px" },
                        <?php if(isset($other_tb_name)){ ?>
                { command: { text: "<?php echo $Lang->add; ?>", click: selectRowMan }, title: " ", width: "140px" }
            <?php }?>
            ]
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

                }).data("kendoWindow");

        $('#addNewMan').click(function(e){
            e.preventDefault();
            var title = $(this).attr('title');
            var tb_name = $(this).attr('fromTable');
            $.ajax({
                url:'<?php echo ROOT; ?>add/man/'+tb_name,
                dataType : 'html',
                success:function(data){
                    removeItem();
                    addItem(data,title);
                }
            });
        });

        });

        function showDetailsMan(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            $('.k-window-title').html("<?php echo $Lang->ties_man; ?>"+dataItem.id);
            wnd.refresh({ url: '<?php echo ROOT; ?>open/manJoins/'+dataItem.id });
            wnd.center().open();
        }

        function openWord(e) {
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            window.open('<?php echo ROOT; ?>word/man_with_joins/'+dataItem.id, '_blank' );
        }

        function setDateTimeP(element) {
            element.kendoDateTimePicker({
                format: "yyyy-MM-dd HH:mm",
                timeFormat: "HH:mm"
            });
        }
        function setDatePicker(element){
            element.kendoDatePicker({
                format: "yyyy-MM-dd HH:mm"
            })
        }
        function selectRowMan(e){
            e.preventDefault();
            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
        <?php if (isset($other_tb_name)) { ?>
            <?php if($other_tb_name == 'work_activity') { ?>
                    work_activity_man(dataItem.id);
                <?php }elseif($other_tb_name == 'event') { ?>
                    event_has_man(dataItem.id);
                <?php } ?>
            <?php } ?>
        }



    </script>
</div>