<div class="loginForm">
    <form method="post" >
        <div>
            <label for="username"><?php echo $Lang->user_name;?></label>
            <input type="text" id="username" name="username" />
        </div>
        <div>
            <label for="password"><?php echo $Lang->password;?></label>
            <input type="password" id="password" name="password" />
        </div>
        <div>
            <input type="submit"  class="k-button" value="<?php echo $Lang->login;?>" />
        </div>
    </form>
</div>
