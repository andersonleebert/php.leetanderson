<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="user_login.php" method="post">
        Username: <input type="text" name="user_username" value="<?php echo (isset($dataValues['user_username']) ? $dataValues['user_username'] : ""); ?>"/><br>
        Password: <input type="text" name="user_password" value="<?php echo (isset($dataValues['user_password']) ? $dataValues['user_password'] : ""); ?>"/><br>
        <input type="submit" name="btnSubmit" value="Login"/>
    </form> 
    <div>Errors: <?php var_dump($user->errors); ?></div>
</body>
</html>
