<a class="closeButton"></a>
<div class="inContent">
    <form id="essayForm">





        <div class="forForm">
            <label for="essayDocumentNumber"><?php echo $Lang->document_number;?></label>
            <input type="text" name="document_number" id="essayDocumentNumber"/>
        </div>

        <div class="forForm">
            <label for="essayDateReg"><?php echo $Lang->date_reg;?></label>
            <input type="text" name="date_reg" id="essayDateReg"/>
        </div>

        <div class="forForm">
            <label for="essayAddressMaterial"><?php echo $Lang->address_material;?></label>
            <input type="text" name="address_material" id="essayAddressMaterial"/>
        </div>

        <div class="forForm">
            <label for="essayDocumentCategory"><?php echo $Lang->document_category;?></label>
            <input type="button" dataName="essayDocumentCategory" dataId="essayDocumentCategoryId" dataTableName="fancy/doc_category" class="addMore k-icon k-i-plus"   />
            <input type="text" name="document_category" id="essayDocumentCategory"/>
            <input type="hidden" name="document_category_id" id="essayDocumentCategoryId" />
        </div>

        <div class="forForm">
            <label for="essayInformationRegardingPerson"><?php echo $Lang->information_regarding_person;?></label>
            <input type="text" name="information_regarding_person" id="essayInformationRegardingPerson"/>
        </div>

        <div class="forForm">
            <label for="essayInformationCountry"><?php echo $Lang->information_country;?></label>
            <input type="button" dataName="essayInformationCountry" dataId="essayInformationCountryId" dataTableName="fancy/country" class="addMore k-icon k-i-plus"   />
            <input type="text" name="information_country" id="essayInformationCountry"/>
            <input type="hidden" name="information_country_id" id="essayInformationCountryId" />
        </div>

        <div class="forForm">
            <label for="essayNameSubject"><?php echo $Lang->name_subject;?></label>
            <input type="text" name="name_subject" id="essayNameSubject"/>
        </div>

        <div class="forForm">
            <label for="essayPeriodTime"><?php echo $Lang->period_time;?></label>
            <input type="text" name="period_time" id="essayPeriodTime"/>
        </div>

        <div class="forForm">
            <label for="essayTitleDocument"><?php echo $Lang->title_document;?></label>
            <input type="text" name="title_document" id="essayTitleDocument"/>
        </div>

        <div class="forForm">
            <label for="essayContentsDocument"><?php echo $Lang->contents_document;?></label>
            <input type="text" name="contents_document" id="essayContentsDocument"/>
        </div>



        <div class="buttons"></div>

    </form>
</div>

<script>
    var currentInputNameEssay;
    var currentInputIdEssay;
    $(document).ready(function(){

        $('#essayDocumentCategory').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/doc_category/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#essayDocumentCategoryId').val(dataItem.id);
            }
        });



        $('#essayInformationCountry').kendoAutoComplete({
            dataTextField: "name",
            dataSource: {
                transport: {
                    read:{
                        dataType: "json",
                        url: "<?php echo ROOT;?>dictionary/1/read"
                    }
                }
            },
            select:function(e){
                var dataItem = this.dataItem(e.item.index());
                $('#essayInformationCountryId').val(dataItem.id);
            }
        });










        $('.addMore').click(function(e){
            e.preventDefault();
            var url = $(this).attr('dataTableName');
            currentInputNamePhone = $(this).attr('dataName');
            currentInputIdPhone = $(this).attr('dataId');
            $.fancybox({
                'type'  : 'iframe',
                'autoSize': false,
                'width'             : 800,
                'height'            : 600,
                'href'              : "<?php echo ROOT;?>autocomplete/"+url
            });
        });

    });



</script>

