<div style="width: 100%;">
    <table class="tableDetails">
        <tr>
            <td><?php echo $Lang->character_link;?></td>
            <td><?php if(!empty($data['relation_type'])){ echo $data['relation_type']; }?></td>
        </tr>
        <tr>
            <td><?php echo $Lang->specific_link;?></td>
            <td> <?php if($data['first_object_type'] == 'man' ){
                                       echo $Lang->face;
                }else{
                echo $Lang->organization;
                }
                echo ' : '.$data['first_object_id'];
                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $Lang->specific_link;?></td>
            <td><?php if($data['second_obejct_type'] == 'man' ){
                                       echo $Lang->face;
                }else{
                echo $Lang->organization;
                }
                echo ' : '.$data['second_object_id'];
                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $Lang->relationship_objects.' : '.$data['id']; ?></td>
            <td><a href="" class="k-button viewTies<?php echo $_SESSION['counter']; ?>"><?php echo $Lang->ties; ?></a></td>
        </tr>
     </table>
</div>
<div class="details<?php echo $_SESSION['counter']; ?>"></div>
<script>
    $(document).ready(function(){

        var wndT<?php echo $_SESSION['counter']; ?> = $(".details<?php echo $_SESSION['counter']; ?>")
            .kendoWindow({
                title: "<?php echo $Lang->relationship_objects.' : '.$data['id']; ?>",
                modal: false,
                visible: false,
                resizable: true,
                actions: ["Minimize","Maximize", "Close"],
                width: 600,
                height: 450

            }).data("kendoWindow");

        $('.viewTies<?php echo $_SESSION['counter']; ?>').live('click',function(e){
            e.preventDefault();
            wndT<?php echo $_SESSION['counter']; ?>.refresh({ url: '<?php echo ROOT; ?>open/objectsRelationJoins/<?php echo $data['id']; ?>' });
            wndT<?php echo $_SESSION['counter']; ?>.center().open();
        });
    });
</script>