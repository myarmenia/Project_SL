<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->position; ?></td>
            <td><?php if(!empty($data['work_activity']['title'])){ echo $data['work_activity']['title']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->period; ?></td>
            <td><?php if(!empty($data['work_activity']['period'])){ echo $data['work_activity']['period']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->start_employment; ?></td>
            <td><?php if(!empty($data['work_activity']['start_date'])){ echo $data['work_activity']['start_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->end_employment; ?></td>
            <td><?php if(!empty($data['work_activity']['end_date'])){ echo $data['work_activity']['end_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->organization; ?></td>
            <td><?php if(!empty($data['work_activity']['organization'])){ echo $data['work_activity']['organization']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->face; ?></td>
            <td><?php if(!empty($data['work_activity']['man'])){ echo $data['work_activity']['man']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->work_activity.' : '.$data['work_activity']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){
        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->work_activity.' : '.$data['work_activity']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/workActivityJoins/<?php echo $data['work_activity']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>