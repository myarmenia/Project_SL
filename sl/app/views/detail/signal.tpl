<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->reg_number_signal; ?></td>
            <td><?php if(!empty($data['signal']['reg_num'])){ echo $data['signal']['reg_num']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->contents_information_signal; ?></td>
            <td><?php if(!empty($data['signal']['content'])){ echo $data['signal']['content']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->line_which_verified; ?></td>
            <td><?php if(!empty($data['signal']['check_line'])){ echo $data['signal']['check_line']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->check_status_charter; ?></td>
            <td><?php if(!empty($data['signal']['check_status'])){ echo $data['signal']['check_status']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->qualifications_signaling; ?></td>
            <td><?php if(!empty($data['signal']['signal_qualification'])){ echo $data['signal']['signal_qualification']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_category; ?></td>
            <td><?php if(!empty($data['signal']['resource'])){ echo $data['signal']['resource']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->checks_signal; ?></td>
            <td><?php if(!empty($data['signal']['check_agency'])){ echo $data['signal']['check_agency']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->department_checking; ?></td>
            <td><?php if(!empty($data['signal']['check_unit'])){ echo $data['signal']['check_unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->unit_testing; ?></td>
            <td><?php if(!empty($data['signal']['check_subunit'])){ echo $data['signal']['check_subunit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->name_checking_signal; ?></td>
            <td><?php if(!empty($data['signal']['checking_worker'])){ echo $data['signal']['checking_worker']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->worker_post; ?></td>
            <td><?php if(!empty($data['signal']['checking_worker_post'])){ echo $data['signal']['checking_worker_post']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_registration_division; ?></td>
            <td><?php if(!empty($data['signal']['subunit_date'])){ echo $data['signal']['subunit_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->check_date; ?></td>
            <td><?php if(!empty($data['signal']['check_date'])){ echo $data['signal']['check_date']; }?></td>
        </tr>

        <tr>
            <td><?php echo $Lang->date_actual; ?></td>
            <td><?php if(!empty($data['signal']['end_date'])){ echo $data['signal']['end_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->useful_capabilities; ?></td>
            <td><?php if(!empty($data['signal']['signal_used_resource'])){ echo $data['signal']['signal_used_resource']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->signal_results; ?></td>
            <td><?php if(!empty($data['signal']['signal_result'])){ echo $data['signal']['signal_result']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->measures_taken; ?></td>
            <td><?php if(!empty($data['signal']['taken_measure'])){ echo $data['signal']['taken_measure']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->according_result_dow; ?></td>
            <td><?php if(!empty($data['signal']['opened_dou'])){ echo $data['signal']['opened_dou']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->brought_signal; ?></td>
            <td><?php if(!empty($data['signal']['opened_agency'])){ echo $data['signal']['opened_agency']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->department_brought; ?></td>
            <td><?php if(!empty($data['signal']['opened_unit'])){ echo $data['signal']['opened_unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->measures_taken; ?></td>
            <td><?php if(!empty($data['signal']['opened_subunit'])){ echo $data['signal']['opened_subunit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->name_operatives; ?></td>
            <td><?php if(!empty($data['signal']['worker'])){ echo $data['signal']['worker']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->worker_post; ?></td>
            <td><?php if(!empty($data['signal']['worker_post'])){ echo $data['signal']['worker_post']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->amount_overdue; ?></td>
            <td><?php if(!empty($data['signal']['count_days'])){ echo $data['signal']['count_days']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->signal.' : '.$data['signal']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
     </table>
</div>

<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){
        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->signal.' : '.$data['signal']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/signalJoins/<?php echo $data['signal']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>