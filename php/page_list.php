<?php
session_start();
require_once('../inc/pages.class.php');
$pages = new pages();
$pages->checkLogin();
if (isset( $_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['page']) )
{
    if ($pages->deleteRecord($_GET['page']))
    {
        header("location:saved.php?return=page");
        exit;
    }
}

if ( !isset($_GET['search']) )
{
    $_GET['search'] = "";
}
$pageResults = $pages->getList($_GET['search']);

$columnsToDisplay = 
array(
    "pages_title" => "Title",
    "pages_h1" => "Heading",
    "pages_url_key" => "URL"
);

include_once("../tpl/page_list.tpl.php");


?>
