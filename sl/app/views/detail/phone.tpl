<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->phone_number; ?></td>
            <td><?php if(!empty($data['phone']['number'])){ echo $data['phone']['number']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->additional_data; ?></td>
            <td><?php if(!empty($data['phone']['more_data'])){ echo $data['phone']['more_data']; }?></td>
        </tr>
        <?php if(isset($data['phone']['character'])) { ?>
            <tr>
                <td><?php echo $Lang->nature_character; ?></td>
                <td><?php if(!empty($data['phone']['character'])){ echo $data['phone']['character']; }?></td>
            </tr>
        <?php } ?>
        <tr>
            <td><?php echo $Lang->telephone_number.' : '.$data['phone']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){
        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->telephone_number.' : '.$data['phone']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/phoneJoins/<?php echo $data['phone']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>