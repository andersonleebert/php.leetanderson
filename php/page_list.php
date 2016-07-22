<?php
session_start();
require_once('../inc/pages.class.php');
$pages = new pages();
$pages->checkLogin();
if (isset( $_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['page']) )
{
    if ($pages->deleteRecord($_GET['page']))
    {
        header("location:admin.php?r=saved&return=pages");
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
$pageResults = $pages->getList($_GET['search']);

$columnsToDisplay = 
array(
    "pages_title" => "Title",
    "pages_h1" => "Heading",
    "pages_url_key" => "URL"
);


?>
