<?php
session_start();
require_once("../inc/user.class.php");

if (isset($_GET['btnCancel'])) 
{
    header("location: user_list.php");
    exit;
}

$userObject = new user();
$userObject->checkLogin();
if($_SESSION['user_permission_id'] != "fb694fee-e4a4-11e5-9e77-7a8325307fec")
{
    // not an admin
    header("location:user_list.php");
    exit;
}

if (isset($_GET['download']) && $_GET['download'] == "yes")
{
    $userObject->downloadReport($_GET);
    exit;
}

$permissions = $userObject->getAllPermissions();

if (isset($_GET['btnSubmit']))
{
    unset($_GET['btnSubmit']);
    $userResults = $userObject->getReportData($_GET);
}



include_once("../tpl/user_report.tpl.php");
?>
