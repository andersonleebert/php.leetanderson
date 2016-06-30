<?php
session_start();
require_once('../inc/newsArticle.class.php');
$news = new newsArticle();
$news->checkLogin();
if (isset( $_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['article_id']) )
{
    if ($news->deleteRecord($_GET['article_id']))
    {
        header("location:saved.php?return=news");
        exit;
    }
}

if ( !isset($_GET['search']) )
{
    $_GET['search'] = "";
}
$newsResults = $news->loadAllArticles($_GET['search']);

$columnsToDisplay = 
array(
    "article_title" => "Title",
    "article_date" => "Date",
    "article_author" => "Author"
);

include_once("../tpl/news_list.tpl.php");


?>


