<div style="width: 100%;">
    <table class="tableDetails">
        <?php if(isset($data)) {
        if(!empty($data)) {
        foreach($data as $val) { ?>
            <tr style="cursor: pointer;">
                <td class="downloadFile" data-id="<?php echo $val['id']; ?>">Файл <?php echo $val['name']; ?> </td>
            </tr>
        <?php       }
            }
        } ?>
     </table>
</div>
