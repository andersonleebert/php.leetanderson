<?php
session_start();

require_once('../inc/user.class.php');
$user = new user();
$user->checkLogin();

if (isset( $_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id']) )
{
    if ($user->deleteRecord($_GET['user_id']))
    {
        header("location:saved.php?return=user");
        exit;
    }
}

$userData = $user->loadAllUsers($_GET['search'] || '');

$columnsToDisplay = 
array(
    "user_username" => "Username",
    "user_password" => "Password",
    "user_id" => "ID",
    "user_permission_id" => "Permission"
);

if($_SESSION['user_permission_id'] == "fb694fee-e4a4-11e5-9e77-7a8325307fec")
{
    // admin
    $isAdminUser = true;
}
else
{
    $isAdminUser = false;
}

include_once("../tpl/user_list.tpl.php");


?>
