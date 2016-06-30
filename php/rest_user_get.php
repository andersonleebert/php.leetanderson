<?php
session_start();
require_once('../inc/user.class.php');
$userObject = new user();
$userObject->checkLogin();
if (isset($_POST['id']) && !empty($_POST['id']))
{
    $userObject->load(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
    $users = $userObject->data;
}
else
{
    $userSTMT = $userObject->getList();
    $users = $userSTMT->fetchAll(PDO::FETCH_ASSOC);
}
echo json_encode($users);

?>
