<a class="closeButton" xmlns="http://www.w3.org/1999/html"></a>
<div class="inContent" style="width: 800px !important;">
    <form id="search" action="<?php echo ROOT; ?>templatesearch/result_bibliography" method="post">

        <div class="forForm">
            <label for="fileSearch"><?php echo $Lang->file_search; ?></label>
            <input type="text" name="content" id="fileSearch"/>
        </div>

        <div class="buttons">
            <input type="submit" value="<?php echo $Lang->search; ?>" />
        </div>
    </form>
    <label style="float: left;width: 700px;text-align: left;font-weight: bold;text-decoration: underline;"><?php echo $Lang->help;?></label>
    <div style="text-align: justify;float: left;">
        <ul style="text-align: justify;float: left;margin-left: -25px;">
            <li style="text-align: justify;float: left;"><?php echo $Lang->help_2;?></li>
            <li style="text-align: justify;float: left;width: 600px;"><?php echo $Lang->help_3;?></li>
            <li style="text-align: justify;float: left;width: 600px;"><?php echo $Lang->help_4;?></li>
        </ul>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('#search').on('submit', function(e){
            if( $('#fileSearch').val().length == 0 ){
                e.preventDefault();
            }
        });
    });
</script>

