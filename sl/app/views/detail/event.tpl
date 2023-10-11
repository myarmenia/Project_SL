<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->qualification_event; ?></td>
            <td><?php if(!empty($data['event']['event_qualification'])){ echo $data['event']['event_qualification']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_security_date; ?></td>
            <td><?php if(!empty($data['event']['date'])){ echo $data['event']['date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->ensuing_effects; ?></td>
            <td><?php if(!empty($data['event']['aftermath'])){ echo $data['event']['aftermath']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->investigation_requested; ?></td>
            <td><?php if(!empty($data['event']['agency'])){ echo $data['event']['agency']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->results_event; ?></td>
            <td><?php if(!empty($data['event']['result'])){ echo $data['event']['result']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_event; ?></td>
            <td><?php if(!empty($data['event']['resource'])){ echo $data['event']['resource']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->event.' : '.$data['event']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>

    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->event.' : '.$data['event']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/eventJoins/<?php echo $data['event']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>