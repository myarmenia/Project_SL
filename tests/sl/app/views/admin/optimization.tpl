
<div id="tabstrip" style="height:100%">
    <ul>
        <li class="k-state-active"><?php echo $Lang->bibliography; ?></li>
        <li><?php echo $Lang->face; ?></li>
        <li><?php echo $Lang->organization; ?></li>
        <li><?php echo $Lang->control; ?></li>
        <li><?php echo $Lang->mia_summary; ?></li>
        <li><?php echo $Lang->action; ?></li>
        <li><?php echo $Lang->event; ?></li>
        <li><?php echo $Lang->criminal; ?></li>
        <li><?php echo $Lang->signal; ?></li>
        <li><?php echo $Lang->address; ?></li>
        <li><?php echo $Lang->keep_signal; ?></li>
        <li><?php echo $Lang->external_signs; ?></li>
        <li><?php echo $Lang->man_bean_country; ?></li>
        <li><?php echo $Lang->telephone; ?></li>
        <li><?php echo $Lang->email; ?></li>
        <li><?php echo $Lang->work_activity; ?></li>
        <li><?php echo $Lang->relationship_objects; ?></li>
        <li><?php echo $Lang->car; ?></li>
        <li><?php echo $Lang->weapon; ?></li>
    </ul>
</div>
<script>


    $(document).ready(function(e){

        $("#tabstrip").kendoTabStrip({
            animation: { open: { effects: "fadeIn"} },
            contentUrls: [
                '<?php echo ROOT; ?>admin/optimization_bibliography/1',
                '<?php echo ROOT; ?>admin/optimization_man/1',
                '<?php echo ROOT; ?>admin/optimization_organization/1',
                '<?php echo ROOT; ?>admin/optimization_control/1',
                '<?php echo ROOT; ?>admin/optimization_mia_summary/1',
                '<?php echo ROOT; ?>admin/optimization_action/1',
                '<?php echo ROOT; ?>admin/optimization_event/1',
                '<?php echo ROOT; ?>admin/optimization_criminal_case/1',
                '<?php echo ROOT; ?>admin/optimization_signal/1',
                '<?php echo ROOT; ?>admin/optimization_address/1',
                '<?php echo ROOT; ?>admin/optimization_keep_signal/1',
                '<?php echo ROOT; ?>admin/optimization_external_sign/1',
                '<?php echo ROOT; ?>admin/optimization_man_bean_country/1',
                '<?php echo ROOT; ?>admin/optimization_phone/1',
                '<?php echo ROOT; ?>admin/optimization_email/1',
                '<?php echo ROOT; ?>admin/optimization_work_activity/1',
                '<?php echo ROOT; ?>admin/optimization_objects_relation/1',
                '<?php echo ROOT; ?>admin/optimization_car/1',
                '<?php echo ROOT; ?>admin/optimization_weapon/1'
            ]
        });

    });
</script>