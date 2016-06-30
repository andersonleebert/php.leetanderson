<?php
session_start();
require_once('../inc/pages.class.php');

$pages = new pages();
$pages->checkLogin();
if ( isset($_GET['page']) )
{
    $pages->loadByURLKey($_GET['page']);
} 
elseif ( isset($_POST['page']) ) 
{
    $pages->loadByURLKey($_POST['page']);
}

if (isset($_POST['btnSubmit']))
{
    unset($_POST['btnSubmit']);
    $_POST['pages_image_size'] = $_FILES['pages_image']['size'];
    $_POST['pages_image_name'] = $_FILES['pages_image']['name'];
    $_POST['pages_image_tmpname'] = $_FILES['pages_image']['tmp_name'];

    $pages->set($_POST);
    if ($pages->validate()) 
    {
        $pages->data['pages_image'] = $pages->moveUpload( $pages->data['pages_image_tmpname'], "images/", $pages->data['pages_image_name']);
        unset($pages->data['pages_image_size']);
        unset($pages->data['pages_image_name']);
        unset($pages->data['pages_image_tmpname']);

        if ($pages->save()) 
        {
            header("location:saved.php?return=page");
            exit;
        }
    }
}

$dataValues = $pages->data;

include_once("../tpl/page_edit.tpl.php");
?>
