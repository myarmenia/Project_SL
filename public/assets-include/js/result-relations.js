function showDetailsRelation(e) {
    e.preventDefault();
    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
    var table_name = $('#table').attr('data-tb-name')

    let dataObj = {
        table_name: table_name,
        table_id: dataItem.id,
    };
    postDataRelation(dataObj,'fetchContactPost');

}
