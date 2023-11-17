<?php if(empty($data)) { ?>
        <p style="width: 100%;text-align: center;"> <?php echo $Lang->no_link;?> </p>
<?php }else{ ?>
        <ul class="actionPanelBar">
            <?php foreach($data as $val){ ?>
                <li>
                    <?php
                        switch($val['tb_name']){
                            case 'man': echo $Lang->face;break;
                            case 'action': echo $Lang->action;break;
                            case 'event': echo $Lang->event;break;
                            case 'organization': echo $Lang->organization;break;
                            case 'address': echo $Lang->address;break;
                            case 'phone': echo $Lang->telephone;break;
                            case 'weapon': echo $Lang->weapon;break;
                            case 'car': echo $Lang->car;break;
                            case 'bibliography': echo $Lang->bibliography;break;
                            case 'signal': echo $Lang->signal;break;
                            case 'criminal_case': echo $Lang->criminal_case;break;
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
            $(".actionPanelBar").kendoPanelBar({
                expandMode: "single",
                contentUrls: contentUrls
            });
        <?php }?>

    });
</script>