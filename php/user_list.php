<?php
session_start();

require_once('../inc/user.class.php');
$user = new user();
$user->checkLogin();

if (isset( $_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id']) )
{
    if ($user->deleteRecord($_GET['user_id']))
    {
        header("location:admin.php?r=saved&return=users");
        exit;
    }
}

if ( !isset($_GET['search']) )
{
    $_GET['search'] = "";
}
else
{
    $_GET['search'] = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
}

$userData = $user->loadAllUsers($_GET['search']);
$permissionColumn = "user_permission_id";
$columnsToDisplay = 
array(
    "user_username" => "Username",
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

?>
