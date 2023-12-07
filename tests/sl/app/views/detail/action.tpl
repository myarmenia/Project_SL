<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->content_materials_actions; ?></td>
            <td><?php if(!empty($data['action']['material_content'])){ echo $data['action']['material_content']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->start_action_date; ?></td>
            <td><?php if(!empty($data['action']['start_date'])){ echo $data['action']['start_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->end_action_date; ?></td>
            <td><?php if(!empty($data['action']['end_date'])){ echo $data['action']['end_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->duration_action; ?></td>
            <td><?php if(!empty($data['action']['duration'])){ echo $data['action']['duration']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->purpose_motive_reason; ?></td>
            <td><?php if(!empty($data['action']['goal'])){ echo $data['action']['goal']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->terms_actions; ?></td>
            <td><?php if(!empty($data['action']['terms'])){ echo $data['action']['terms']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->ensuing_effects; ?></td>
            <td><?php if(!empty($data['action']['aftermath'])){ echo $data['action']['aftermath']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_information_actions; ?></td>
            <td><?php if(!empty($data['action']['source'])){ echo $data['action']['source']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->opened_dou; ?></td>
            <td><?php if(!empty($data['action']['opened_dou'])){ echo $data['action']['opened_dou']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->qualification_fact; ?></td>
            <td><?php if(!empty($data['action']['action_qualification'])){ echo $data['action']['action_qualification']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->action.' : '.$data['action']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>

    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->action.' : '.$data['action']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/actionJoins/<?php echo $data['action']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>