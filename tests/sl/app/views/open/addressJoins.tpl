<?php if(empty($data)) { ?>
        <p style="width: 100%;text-align: center;"> <?php echo $Lang->no_link;?> </p>
<?php }else{ ?>
        <ul class="addressPanelBar">
            <?php foreach($data as $val){ ?>
                <li>
                    <?php
                        switch($val['tb_name']){
                            case 'man': echo $Lang ->face;break;
                            case 'action': echo $Lang->action;break;
                            case 'event': echo $Lang->event;break;
                            case 'organization': echo $Lang->organization;break;
                            case 'car': echo $Lang->car;break;
                        }
                        echo ":id=".$val['id']; ?>
                    <div></div>
                </li>
            <?php }?>
        </ul>
<?php } ?>

<script>
    $(document).ready(function(){
        <?php if(!empty($data)) { ?>
            var contentUrls = [
                <?php foreach($data as $val ){
                    echo "'".ROOT."detail/".$val['tb_name']."/".$val['id']."',";
                }?>
            ];
            $(".addressPanelBar").kendoPanelBar({
                expandMode: "single",
                contentUrls: contentUrls
            });
        <?php }?>

    });
</script>