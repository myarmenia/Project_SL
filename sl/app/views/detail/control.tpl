<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->unit; ?></td>
            <td><?php if(!empty($data['control']['unit'])){ echo $data['control']['unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->document_category; ?></td>
            <td><?php if(!empty($data['control']['doc_category'])){ echo $data['control']['doc_category']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->document_date; ?></td>
            <td><?php if(!empty($data['control']['creation_date'])){ echo $data['control']['creation_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->reg_document; ?></td>
            <td><?php if(!empty($data['control']['reg_num'])){ echo $data['control']['reg_num']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_reg; ?></td>
            <td><?php if(!empty($data['control']['reg_date'])){ echo $data['control']['reg_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->director; ?></td>
            <td><?php if(!empty($data['control']['snb_director'])){ echo $data['control']['snb_director']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->deputy_director; ?></td>
            <td><?php if(!empty($data['control']['snb_subdirector'])){ echo $data['control']['snb_subdirector']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->date_resolution; ?></td>
            <td><?php if(!empty($data['control']['resolution_date'])){ echo $data['control']['resolution_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->resolution; ?></td>
            <td><?php if(!empty($data['control']['resolution'])){ echo $data['control']['resolution']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->department_performer; ?></td>
            <td><?php if(!empty($data['control']['act_unit'])){ echo $data['control']['act_unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->actor_name; ?></td>
            <td><?php if(!empty($data['control']['actor_name'])){ echo $data['control']['actor_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->department_coauthors; ?></td>
            <td><?php if(!empty($data['control']['sub_act_unit'])){ echo $data['control']['sub_act_unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->actor_name; ?></td>
            <td><?php if(!empty($data['control']['sub_actor_name'])){ echo $data['control']['sub_actor_name']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->result_execution; ?></td>
            <td><?php if(!empty($data['control']['result'])){ echo $data['control']['result']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->control.' : '.$data['control']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>

     </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->control.' : '.$data['control']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/controlJoins/<?php echo $data['control']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>