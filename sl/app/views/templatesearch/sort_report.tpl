<?php $count = 1; ?>
<form id="sort_form" method="post">
    <table class="tableDetails">
        <?php foreach($data as $key=>$val) { ?>
            <tr id="tr<?php echo $count; ?>">
                <td><?php echo $count; ?></td>
                <td><label><input type="checkbox" class="all_check" value="<?php echo $key;?>"><?php echo $val; ?></label></td>
                <td>
                    <select id="<?php echo $key;?>">
                        <option value="ASC"> по возрастанию </option>
                        <option value="DESC"> по убыванию </option>
                    </select>
                </td>
                <td>
                    <a class="up k-button"><span class="k-icon k-i-arrow-n"></span></a>
                    <a class="down k-button"><span class="k-icon k-i-arrow-s"></span></a>
                </td>
            </tr>
        <?php $count++; } ?>
    </table>
    <div class="buttons">
        <a class="send k-button" id="arm" style="width: 200px;margin: 0px auto;"><?php echo $Lang->report_search; ?> (Հայ.)</a>
        <a class="send k-button" id="rus" style="width: 200px;margin: 0px auto;"><?php echo $Lang->report_search; ?> (Рус.)</a>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('.up, .down').click(function(e){
            e.preventDefault();
            var row = $(this).parents("tr:first");
            if ($(this).is(".up")) {
                row.insertBefore(row.prev());
            }
            else {
                row.insertAfter(row.next());
            }
            $('tbody tr td:first-child').each(function(idx, item) {
                $(this).text(idx+1);
            });
        });
        $('.send').click(function(e){
            e.preventDefault();
            var for_sort = [];
            var count = 0;
            $('input:checkbox:checked.all_check').map(function () {
                for_sort[count] = {'name' : this.value ,'sort' : $('#'+this.value).val() };
                count++;
            });
            var lang = $(this).attr('id');
            parent.closeSortFancy(for_sort,lang)
        });
    });
</script>