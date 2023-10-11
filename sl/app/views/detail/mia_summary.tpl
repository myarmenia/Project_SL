<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->date_registration_reports; ?></td>
            <td><?php if(!empty($data['mia_summary']['date'])){ echo $data['mia_summary']['date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->content_inf; ?></td>
            <td><?php if(!empty($data['mia_summary']['content'])){ echo $data['mia_summary']['content']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->mia_summary.' : '.$data['mia_summary']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
     </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->mia_summary.' : '.$data['mia_summary']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/miaSummaryJoins/<?php echo $data['mia_summary']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>