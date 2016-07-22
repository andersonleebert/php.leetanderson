<?php
session_start();
require_once('../inc/newsArticle.class.php');
$news = new newsArticle();
$news->checkLogin();
if (isset( $_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['article_id']) )
{
    if ($news->deleteRecord($_GET['article_id']))
    {
        header("location:admin.php?r=saved&return=news");
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
$newsResults = $news->loadAllArticles($_GET['search']);

$dateColumn = "article_date";
$columnsToDisplay = 
array(
    "article_title" => "Title",
    "article_date" => "Date",
    "article_author" => "Author"
);

?>


