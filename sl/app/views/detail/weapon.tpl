<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->weapon_cat; ?></td>
            <td><?php if(!empty($data['weapon']['category'])){ echo $data['weapon']['category']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->view; ?></td>
            <td><?php if(!empty($data['weapon']['view'])){ echo $data['weapon']['view']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->type; ?></td>
            <td><?php if(!empty($data['weapon']['type'])){ echo $data['weapon']['type']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->mark; ?></td>
            <td><?php if(!empty($data['weapon']['model'])){ echo $data['weapon']['model']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->account_number; ?></td>
            <td><?php if(!empty($data['weapon']['reg_num'])){ echo $data['weapon']['reg_num']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->count; ?></td>
            <td><?php if(!empty($data['weapon']['count'])){ echo $data['weapon']['count']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->weapon.' : '.$data['weapon']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){
        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->weapon.' : '.$data['weapon']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/weaponJoins/<?php echo $data['weapon']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>