<div id="example" class="k-content">
    <div id="grid"></div>


    <script type="text/x-kendo-template" id="template">
        <div id="details-container" >

            <h2>#= user_name # #= created_at #</h2>
            <em>#= doc_name #</em>
            <dl>
                <dt>City: #= doc_name #</dt>
                <dt>Birth Date: #= kendo.toString(created_at, "yyyy-MM-dd HH:mm") #</dt>
            </dl>
        </div>
    </script>


   <div id="details" style= ""></div>

    <script>


        var wnd;
        var detailsTemplate;
//



        $(document).ready(function () {



            dataSource = new kendo.data.DataSource({
                transport: {
                        read:  {
                            url:"<?php echo ROOT;?>test/bibliography/read",
                            dataType: "json"
                        },

                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                return {models: kendo.stringify(options.models)};
                            }
                        }
                    },
                    batch: true,
                    pageSize: 20,
                    schema: {
                        model: {
                            id: "id",
                            fields: {
                                id: { editable: false, nullable: false }
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
                            startswith: "Начинается с",
                            eq: "Равно",
                            neq: "Не равно",
                            contains: "Содержит"
                        }
                    },
                    messages: {
                        info: " Искать как ",
                        filter:'Искать',
                        clear:'Отчистить'
                    }
                },
                toolbar: [{name:'create', text:'<?php echo $Lang->createNew;?>'}],
                columns: [
                    { field: "id", title: "Id" ,filterable:false },
                    { field: "user_name", title: "User"  },
                    { field: "doc_name", title: "Category" },
                    { field: "access_level", title: "Access Level"  },
                    { field: "source_agency_name", title: "Source Agency"  },
                    { field: "from_agency_name", title: "From Agency" },
                    { field: "source", title: "Source" },
                    { field: "short_desc", title: "Short Desc"  },
                    { field: "related_year", title: "Related Year" ,filterable: {
                            extra: false,
                            operators: {
                                string: {
                                    eq: "Равно",
                                    neq: "Не равно" ,
                                    gt:'Больше',
                                    gte:'Больше и равно',
                                    lt:'Меньше',
                                    lte:'Меньше и равно'

                                }
                            }
                        }
                    },
                    { field: "source_address", title: "Source Address"  },
                    { field: "created_at", title: "Created At",  format: "{0:yyyy-MM-dd HH:mm:tt}",
                        filterable: {
                            ui: setDateTimeP ,
                            extra: false,
                            operators: {
                                string: {
                                    eq: "Равно",
                                    neq: "Не равно" ,
                                    gt:'Больше',
                                    gte:'Больше и равно',
                                    lt:'Меньше',
                                    lte:'Меньше и равно'

                                }
                            }
                        }
                    },
                    { field: "worker_name", title: "Worker Name"   },
                    { field: "reg_number", title: "Reg Number"   },
                    { field: "reg_date", title: "Reg Date", format: "{0:yyyy-MM-dd}",
                        filterable: {
                            ui: setDatePicker ,
                            extra: false,
                            operators: {
                                string: {
                                    eq: "Равно",
                                    neq: "Не равно" ,
                                    gt:'Больше',
                                    gte:'Больше и равно',
                                    lt:'Меньше',
                                    lte:'Меньше и равно'

                                }
                            }
                        }
                    },
                    { command: { text: "View Details", click: showDetails }, title: " ", width: "140px" }
                ]
            }).data("kendoGrid");



            detailsTemplate = kendo.template($("#template").html());
//


        });

        function showDetails(e) {
            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

//            console.log(dataItem);

            wnd = $("#details")
                    .kendoWindow({
                        title: "Customer Details",
                        modal: false,
                        visible: false,
                        resizable: true,
                        width: 600,
                        height: 450,
                        content:'<?php echo ROOT; ?>open/bibliographyJoins/'+dataItem.id
                    }).data("kendoWindow");
            wnd.center().open();
        }

        function setDateTimeP(element) {
            element.kendoDateTimePicker({
                format: "yyyy-MM-dd HH:mm",
                timeFormat: "HH:mm"
            });
        }
        function setDatePicker(element){
            element.kendoDatePicker({
                format: "yyyy-MM-dd"
            })
        }



    </script>
</div>