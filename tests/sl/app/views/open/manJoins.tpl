<?php if(empty($data)) { ?>
        <p style="width: 100%;text-align: center;"><?php echo $Lang->no_link;?> </p>
<?php }else{ ?>
        <ul class="manPanelBar">
            <?php foreach($data as $val){ ?>
                <li>
                    <?php
                        switch($val['tb_name']){
                            case 'man': echo $Lang->face;break;
                            case 'address': echo $Lang->address;break;
                            case 'phone': echo $Lang->telephone;break;
                            case 'organization_has_man': echo $Lang->work_activity;break;
                            case 'man_bean_country': echo $Lang->man_bean_country;break;
                            case 'sign': echo $Lang->external_signs;break;
                            case 'objects_relation': echo $Lang->relationship_objects;break;
                            case 'action': echo $Lang->action;break;
                            case 'event': echo $Lang->event;break;
                            case 'signal': echo $Lang->signal;break;
                            case 'criminal_case': echo $Lang->criminal_case;break;
                            case 'mia_summary': echo $Lang->mia_summary;break;
                            case 'car': echo $Lang->car;break;
                            case 'weapon': echo $Lang->weapon;break;
                            case 'bibliography': echo $Lang->bibliography;break;
                            case 'organization': echo $Lang->organization;break;
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
                    if($val['tb_name'] == 'man_bean_country'){
                        $val['tb_name'] = 'man_beann_country';
                    }

                    if($val['tb_name'] == 'sign'){
                        $val['tb_name'] = 'external_signs';
                    }

                    echo "'".ROOT."detail/".$val['tb_name']."/".$val['id']."',";
                }?>
            ];
            $(".manPanelBar").kendoPanelBar({
                expandMode: "single",
                contentUrls: contentUrls
            });
        <?php }?>

    });
</script>