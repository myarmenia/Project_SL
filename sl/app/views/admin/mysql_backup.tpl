<a class="closeButton" ></a>
<div class="inContent">
    <form id="user_add" method="POST">
        <div class="buttons">
            <input type="button" class="k-button" value="<?php echo $Lang->mysql_backup;?>" id="mysql_backup" />
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('#mysql_backup').click(function(e){
            $('#preloader').show();
            $.ajax({
                url: '<?php echo ROOT?>admin/mysql_backup',
                type: 'post',
                success: function(data){
                    window.open('<?php echo ROOT?>admin/download','_blank');
                    $('#preloader').hide();
                },
                faild: function(data){
                    alert('<?php echo $Lang->err;?> ');
                }
            });

        });
    });
</script>
