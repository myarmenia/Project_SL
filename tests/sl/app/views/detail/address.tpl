<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->country_ate; ?></td>
            <td><?php if(!empty($data['address']['country_ate'])){ echo $data['address']['country_ate']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->region; ?></td>
            <td><?php if(!empty($data['address']['region'])){ echo $data['address']['region']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->locality; ?></td>
            <td><?php if(!empty($data['address']['locality'])){ echo $data['address']['locality']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->street; ?></td>
            <td><?php if(!empty($data['address']['street'])){ echo $data['address']['street']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->home_num; ?></td>
            <td><?php if(!empty($data['address']['home_num'])){ echo $data['address']['home_num']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->housing_num; ?></td>
            <td><?php if(!empty($data['address']['housing_num'])){ echo $data['address']['housing_num']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->apt_num; ?></td>
            <td><?php if(!empty($data['address']['apt_num'])){ echo $data['address']['apt_num']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->track; ?></td>
            <td><?php if(!empty($data['address']['track'])){ echo $data['address']['track']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->address.' : '.$data['address']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>

    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->address.' : '.$data['address']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/addressJoins/<?php echo $data['address']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>