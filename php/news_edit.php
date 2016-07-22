<?php
session_start();
require_once('../inc/newsArticle.class.php');

$newsArticle = new newsArticle();
$newsArticle->checkLogin();
if (isset($_GET['article_id']))
{
    $newsArticle->load($_GET['article_id']);
} 
elseif (isset($_POST['article_id'])) 
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
            header("location:admin.php?r=saved&return=news");
            exit;
        }
    }
}

$dateTimeNow = new DateTime();
$dateTimeNow = $dateTimeNow->format("Y-m-d H:i:s");
$dataValues = $newsArticle->data;

?>
