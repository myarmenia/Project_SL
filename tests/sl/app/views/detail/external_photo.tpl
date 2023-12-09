<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->time_fixation; ?></td>
            <td><?php if(!empty($data['fixed_date'])){ echo $data['fixed_date']; }?></td>
        </tr>
    </table>
</div>
<img src="data:image/png;base64,<?php echo $data['image']; ?>" />