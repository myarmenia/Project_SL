<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->signs; ?></td>
            <td><?php if(!empty($data['sign']['name'])){ echo $data['sign']['name']; }?></td>
        </tr>

        <tr>
            <td><?php echo $Lang->time_fixation; ?></td>
            <td><?php if(!empty($data['sign']['fixed_date'])){ echo $data['sign']['fixed_date']; }?></td>
        </tr>

    </table>
</div>