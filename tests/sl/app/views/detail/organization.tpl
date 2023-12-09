<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->nation; ?></td>
            <td><?php if(!empty($data['organization']['country'])){ echo $data['organization']['country']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->category_organization; ?></td>
            <td><?php if(!empty($data['organization']['category'])){ echo $data['organization']['category']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->country_ate; ?></td>
            <td><?php if(!empty($data['organization']['country_ate'])){ echo $data['organization']['country_ate']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->name_organization; ?></td>
            <td><?php if(!empty($data['organization']['name'])){ echo $data['organization']['name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_formation; ?></td>
            <td><?php if(!empty($data['organization']['reg_date'])){ echo $data['organization']['reg_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->number_worker; ?></td>
            <td><?php if(!empty($data['organization']['employers_count'])){ echo $data['organization']['employers_count']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->attention; ?></td>
            <td><?php if(!empty($data['organization']['attension'])){ echo $data['organization']['attension']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->opened_dou; ?></td>
            <td><?php if(!empty($data['organization']['opened_dou'])){ echo $data['organization']['opened_dou']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->security_organization; ?></td>
            <td><?php if(!empty($data['organization']['agency'])){ echo $data['organization']['agency']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->organization.' : '.$data['organization']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){
        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->organization.' : '.$data['organization']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/organizationJoins/<?php echo $data['organization']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>