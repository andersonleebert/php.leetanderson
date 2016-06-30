<?php
session_start();
require_once('../inc/newsArticle.class.php');

$newsArticle = new newsArticle();
$newsArticle->checkLogin();
if (isset($_GET['article_id']) && $_GET['article_id'] >0)
{
    $newsArticle->load($_GET['article_id']);
} 
elseif (isset($_POST['article_id']) && $_POST['article_id'] >0) 
{
    $newsArticle->load($_POST['article_id']);
}

if (isset($_POST['btnSubmit']))
{
    unset($_POST['btnSubmit']);
    $newsArticle->set($_POST);
    if ($newsArticle->validate()) 
    {
        if ($newsArticle->save()) 
        {
            header("location:saved.php?return=news");
            exit;
        }
    }
}

$dataValues = $newsArticle->data;

include_once("../tpl/news_edit.tpl.php");
?>
