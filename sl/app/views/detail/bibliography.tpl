<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->date_and_time; ?></td>
            <td><?php if(!empty($data['bibliography']['created_at'])){ echo $data['bibliography']['created_at']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->organ; ?></td>
            <td><?php if(!empty($data['bibliography']['from_agency_name'])){ echo $data['bibliography']['from_agency_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->document_category; ?></td>
            <td><?php if(!empty($data['bibliography']['doc_name'])){ echo $data['bibliography']['doc_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->access_level; ?></td>
            <td><?php if(!empty($data['bibliography']['access_level'])){ echo $data['bibliography']['access_level']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->created_user; ?></td>
            <td><?php if(!empty($data['bibliography']['user_name'])){ echo $data['bibliography']['user_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->reg_document; ?></td>
            <td><?php if(!empty($data['bibliography']['reg_number'])){ echo $data['bibliography']['reg_number']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_reg; ?></td>
            <td><?php if(!empty($data['bibliography']['reg_date'])){ echo $data['bibliography']['reg_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_agency; ?></td>
            <td><?php if(!empty($data['bibliography']['source_agency_name'])){ echo $data['bibliography']['source_agency_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_address; ?></td>
            <td><?php if(!empty($data['bibliography']['source_address'])){ echo $data['bibliography']['source_address']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->short_desc; ?></td>
            <td><?php if(!empty($data['bibliography']['short_desc'])){ echo $data['bibliography']['short_desc']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->worker_take_doc; ?></td>
            <td><?php if(!empty($data['bibliography']['worker_name'])){ echo $data['bibliography']['worker_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->related_year; ?></td>
            <td><?php if(!empty($data['bibliography']['related_year'])){ echo $data['bibliography']['related_year']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_inf; ?></td>
            <td><?php if(!empty($data['bibliography']['source'])){ echo $data['bibliography']['source']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->bibliography.' : '.$data['bibliography']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>

    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->bibliography.' : '.$data['bibliography']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/bibliographyJoins/<?php echo $data['bibliography']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>