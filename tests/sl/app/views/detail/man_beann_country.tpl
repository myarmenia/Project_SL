<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->purpose_visit; ?></td>
            <td><?php if(!empty($data['man_beann_country']['goal'])){ echo $data['man_beann_country']['goal']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->country_ate; ?></td>
            <td><?php if(!empty($data['man_beann_country']['country_ate'])){ echo $data['man_beann_country']['country_ate']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->region; ?></td>
            <td><?php if(!empty($data['man_beann_country']['region'])){ echo $data['man_beann_country']['region']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->locality; ?></td>
            <td><?php if(!empty($data['man_beann_country']['locality'])){ echo $data['man_beann_country']['locality']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->entry_date; ?></td>
            <td><?php if(!empty($data['man_beann_country']['entry_date'])){ echo $data['man_beann_country']['entry_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->exit_date; ?></td>
            <td><?php if(!empty($data['man_beann_country']['exit_date'])){ echo $data['man_beann_country']['exit_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->man_bean_country.' : '.$data['man_beann_country']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->man_bean_country.' : '.$data['man_beann_country']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/manBeannCountryJoins/<?php echo $data['man_beann_country']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>