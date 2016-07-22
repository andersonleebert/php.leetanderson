<?php
session_start();

require_once('../inc/user.class.php');

$user = new user();
if ( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] )
{
    header("location:admin.php?r=pages");
    exit;
}
if (isset($_POST['user_username']) && isset($_POST['user_password'])) 
{
    // try to log them in
    unset($_POST['btnSubmit']);
    $user->set($_POST);
    if ($user->loginUser())
    {
        // if it works redirect
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $user->data['user_id'];
        $_SESSION['user_username'] = $user->data['user_username'];
        $_SESSION['user_permission_id'] = $user->data['user_permission_id'];
        header("location:admin.php?r=pages");
        exit;
    }
    else
    {
        $user->errors[] = "Incorrect username or password";
    }
    
}

if (isset($_POST))
{
    $dataValues = $_POST;
}


?>
