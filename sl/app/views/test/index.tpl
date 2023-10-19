<ul class="carPanelBar">
    <li>
        test
        <div></div>
    </li>
</ul>
<script>
    $(document).ready(function(){
            var contentUrls = [
                   '<?php echo ROOT; ?>detail/event/3'
        ];
            $(".carPanelBar").kendoPanelBar({
                expandMode: "single",
                contentUrls: contentUrls
            });
    });
</script>