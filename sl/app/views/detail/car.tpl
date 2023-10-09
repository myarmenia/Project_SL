<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->car_cat; ?></td>
            <td><?php if(!empty($data['car']['car_category'])){ echo $data['car']['car_category']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->mark; ?></td>
            <td><?php if(!empty($data['car']['car_mark'])){ echo $data['car']['car_mark']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->color; ?></td>
            <td><?php if(!empty($data['car']['car_color'])){ echo $data['car']['car_color']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->car_number; ?></td>
            <td><?php if(!empty($data['car']['number'])){ echo $data['car']['number']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->count; ?></td>
            <td><?php if(!empty($data['car']['count'])){ echo $data['car']['count']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->additional_data; ?></td>
            <td><?php if(!empty($data['car']['note'])){ echo $data['car']['note']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->car.' : '.$data['car']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->car.' : '.$data['car']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/carJoins/<?php echo $data['car']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>