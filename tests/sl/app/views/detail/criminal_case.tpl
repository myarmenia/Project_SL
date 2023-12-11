<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->number_case; ?></td>
            <td><?php if(!empty($data['criminal_case']['number'])){ echo $data['criminal_case']['number']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->criminal_proceedings_date; ?></td>
            <td><?php if(!empty($data['criminal_case']['opened_date'])){ echo $data['criminal_case']['opened_date']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->criminal_code; ?></td>
            <td><?php if(!empty($data['criminal_case']['artical'])){ echo $data['criminal_case']['artical']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->materials_management; ?></td>
            <td><?php if(!empty($data['criminal_case']['opened_agency'])){ echo $data['criminal_case']['opened_agency']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->head_department; ?></td>
            <td><?php if(!empty($data['criminal_case']['unit'])){ echo $data['criminal_case']['unit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->instituted_units; ?></td>
            <td><?php if(!empty($data['criminal_case']['subunit'])){ echo $data['criminal_case']['subunit']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->name_operatives; ?></td>
            <td><?php if(!empty($data['criminal_case']['worker'])){ echo $data['criminal_case']['worker']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->worker_post; ?></td>
            <td><?php if(!empty($data['criminal_case']['worker_post'])){ echo $data['criminal_case']['worker_post']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->nature_materials_paint; ?></td>
            <td><?php if(!empty($data['criminal_case']['character'])){ echo $data['criminal_case']['character']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->initiated_dow; ?></td>
            <td><?php if(!empty($data['criminal_case']['opened_dou'])){ echo $data['criminal_case']['opened_dou']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->created_at; ?></td>
            <td><?php if(!empty($data['criminal_case']['created_at'])){ echo $data['criminal_case']['created_at']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->criminal_case.' : '.$data['criminal_case']['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
    </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->criminal_case.' : '.$data['criminal_case']['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/criminalCaseJoins/<?php echo $data['criminal_case']['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>