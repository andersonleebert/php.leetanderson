<?php
session_start();
require_once('../inc/user.class.php');

$user = new user();
$user->checkLogin();

if (isset($_GET['user_id']))
{
    $user->load($_GET['user_id']);
} 
elseif (isset($_POST['user_id'])) 
{
    $user->load($_POST['user_id']);
}

if (isset($_POST['btnSubmit']))
{
    unset($_POST['btnSubmit']);

    $_POST['user_image_size'] = $_FILES['user_image']['size'];
    $_POST['user_image_name'] = $_FILES['user_image']['name'];
    $_POST['user_image_tmpname'] = $_FILES['user_image']['tmp_name'];
    $user->set($_POST);
    if ($user->validate()) 
    {
        $user->data['user_image'] = $user->moveUpload( $user->data['user_image_tmpname'], "images/", $user->data['user_image_name']);
        unset($user->data['user_image_size']);
        unset($user->data['user_image_name']);
        unset($user->data['user_image_tmpname']);
        
        //$user->data['user_password'] = password_hash($user->data['user_password'], PASSWORD_DEFAULT);
        $user->data['user_password'] = hash("md5", $user->data['user_password']);
        if ($user->save()) 
        {

            header("location:saved.php?return=user");
            exit;
        }
        
    }
}

$dataValues = $user->data;
$permissions = $user->getAllPermissions();

include_once("../tpl/user_edit.tpl.php");
?>
