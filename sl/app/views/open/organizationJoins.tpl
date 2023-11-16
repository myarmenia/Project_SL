<?php if(empty($data)) { ?>
        <p style="width: 100%;text-align: center;"> <?php echo $Lang->no_link;?> </p>
<?php }else{ ?>
        <ul class="organizationPanelBar">
            <?php foreach($data as $val){ ?>
                <li>
                    <?php
                        switch($val['tb_name']){
                            case 'address': echo $Lang ->address;break;
                            case 'organization': echo $Lang->organization;break;
                            case 'phone': echo $Lang->telephone;break;
                            case 'event': echo $Lang->event;break;
                            case 'objects_relation': echo $Lang->relationship_objects;break;
                            case 'criminal_case': echo $Lang->criminal;break;
                            case 'action': echo $Lang->action;break;
                            case 'organization_has_man': echo $Lang->work_activity;break;
                            case 'signal': echo $Lang->signal;break;
                            case 'bibliography': echo $Lang->bibliography;break;
                            case 'car': echo $Lang->car;break;
                            case 'weapon': echo $Lang->weapon;break;
                            case 'mia_summary': echo $Lang->mia_summary;break;
                            case 'man': echo $Lang->face;break;
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
                    if($val['tb_name'] == 'organization_has_man'){
                        $val['tb_name'] = 'work_activity';
                    }
                    echo "'".ROOT."detail/".$val['tb_name']."/".$val['id']."',";
                }?>
            ];
            $(".organizationPanelBar").kendoPanelBar({
                expandMode: "single",
                contentUrls: contentUrls
            });
        <?php }?>

    });
</script>