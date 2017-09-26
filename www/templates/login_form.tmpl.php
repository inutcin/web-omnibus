<?php include("inc/header.inc.tmpl.php");?>
<div class="login">
    <div class="all-fog"></div>
    <form role="form" class="login-form" method="POST">
        <div class="form-group">
            <label for="username"><?= 
                CMessage::Message("LOGIN_USERNAME");              
            ?></label>
            <input type="text" class="form-control" id="username"/ 
            name="username" value="<?= 
                isset($_POST["username"])
                ?
                htmlspecialchars($_POST["username"])
                :
                ''
            ?>">
        </div>
        <div class="form-group">
            <label for="username"><?= 
                CMessage::Message("LOGIN_PASSWORD");              
            ?></label>
            <input type="password" class="form-control" id="password"/ 
            name="password" value="<?= 
                isset($_POST["password"])
                ?
                htmlspecialchars($_POST["password"])
                :
                ''
            ?>">
            
        </div>
        <input type="submit" class="btn btn-default login-submit" value="<?= 
                CMessage::Message("LOGIN_ENTER");              
        ?>"/> 
    </form>
</div>
<?php include("inc/footer.inc.tmpl.php");?>
