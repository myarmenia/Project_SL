<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->management_signal; ?></td>
            <td><?php if(!empty($data['keep_signal']['agency'])){ echo $data['keep_signal']['agency']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->department_checking_signal; ?></td>
            <td><?php if(!empty($data['keep_signal']['unit'])){ echo $data['keep_signal']['unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->unit_signal; ?></td>
            <td><?php if(!empty($data['keep_signal']['sub_unit'])){ echo $data['keep_signal']['sub_unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->unit_signal_transmitted; ?></td>
            <td><?php if(!empty($data['keep_signal']['passed_sub_unit'])){ echo $data['keep_signal']['passed_sub_unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->name_operatives; ?></td>
            <td><?php if(!empty($data['keep_signal']['worker'])){ echo $data['keep_signal']['worker']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->worker_post; ?></td>
            <td><?php if(!empty($data['keep_signal']['worker_post'])){ echo $data['keep_signal']['worker_post']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->start_checking_signal; ?></td>
            <td><?php if(!empty($data['keep_signal']['start_date'])){ echo $data['keep_signal']['start_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->end_checking_signal; ?></td>
            <td><?php if(!empty($data['keep_signal']['end_date'])){ echo $data['keep_signal']['end_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_transfer_unit; ?></td>
            <td><?php if(!empty($data['keep_signal']['pass_date'])){ echo $data['keep_signal']['pass_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->keep_signal.' : '.$data['keep_signal']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
     </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->keep_signal.' : '.$data['keep_signal']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/keepSignalJoins/<?php echo $data['keep_signal']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>