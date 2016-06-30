<?php
session_start();
require_once('../inc/newsArticle.class.php');
$news = new newsArticle();
$news->checkLogin();
$news->exportData("test.csv");
 ?>
