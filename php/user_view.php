<?php
require_once('../inc/user.class.php');
$user = new user();

if (isset($_GET['user_id']) && !empty($_GET['user_id']))
{
    $user->load(filter_var($_GET['user_id'], FILTER_SANITIZE_STRING));
    $userData = $user->data;
}
else
{
    header("location:index.php");
    exit;
}

include_once('../tpl/user_view.tpl.php');

?>
