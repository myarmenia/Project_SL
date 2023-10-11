<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->last_name; ?></td>
            <td><?php if(!empty($data['man']['last_name'])){ echo $data['man']['last_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->first_name; ?></td>
            <td><?php if(!empty($data['man']['first_name'])){ echo $data['man']['first_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->middle_name; ?></td>
            <td><?php if(!empty($data['man']['middle_name'])){ echo $data['man']['middle_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->passport_number; ?></td>
            <td><?php if(!empty($data['man']['passport'])){ echo $data['man']['passport']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->citizenship; ?></td>
            <td><?php if(!empty($data['man']['man_belongs_country'])){ echo $data['man']['man_belongs_country']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->knowledge_of_languages; ?></td>
            <td><?php if(!empty($data['man']['man_knows_language'])){ echo $data['man']['man_knows_language']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_of_birth; ?></td>
            <td><?php if(!empty($data['man']['birthday'])){ echo $data['man']['birthday']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->approximate_year; ?></td>
            <td><?php if(!empty($data['man']['birth_year'])){ echo $data['man']['birth_year']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->gender; ?></td>
            <td><?php if(!empty($data['man']['gender'])){ echo $data['man']['gender']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->nationality; ?></td>
            <td><?php if(!empty($data['man']['nation'])){ echo $data['man']['nation']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->attention; ?></td>
            <td><?php if(!empty($data['man']['attention'])){ echo $data['man']['attention']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->worship; ?></td>
            <td><?php if(!empty($data['man']['religion'])){ echo $data['man']['religion']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->opened_dou; ?></td>
            <td><?php if(!empty($data['man']['opened_dou'])){ echo $data['man']['opened_dou']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->education; ?></td>
            <td><?php if(!empty($data['man']['education'])){ echo $data['man']['education']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->party; ?></td>
            <td><?php if(!empty($data['man']['party'])){ echo $data['man']['party']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->alias; ?></td>
            <td><?php if(!empty($data['man']['nickname'])){ echo $data['man']['nickname']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->occupation; ?></td>
            <td><?php if(!empty($data['man']['occupation'])){ echo $data['man']['occupation']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->operational_category_person; ?></td>
            <td><?php if(!empty($data['man']['operation_category'])){ echo $data['man']['operation_category']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->source_information; ?></td>
            <td><?php if(!empty($data['man']['resource'])){ echo $data['man']['resource']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->face.' : '.$data['man']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->face.' : '.$data['man']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/manJoins/<?php echo $data['man']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>