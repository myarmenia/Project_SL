<?php if(empty($data)) { ?>
        <p style="width: 100%;text-align: center;"> <?php echo $Lang->no_link;?> </p>
<?php }else{ ?>
        <ul class="keepSignalPanelBar">
            <?php foreach($data as $val){ ?>
                <li>
                    <?php
                        switch($val['tb_name']){
                            case 'signal': echo $Lang->signal;break;
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
            $(".keepSignalPanelBar").kendoPanelBar({
                expandMode: "single",
                contentUrls: contentUrls
            });
        <?php }?>

    });
</script>