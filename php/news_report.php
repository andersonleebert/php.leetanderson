<?php
require_once("../inc/newsArticle.class.php");

$newsArticle = new newsArticle();

if (isset($_GET['btnSubmit']))
{
    $newsResults = $newsArticle->getReportData($_GET);
    $columnsToDisplay = 
    array(
        "article_title" => "Title",
        "article_date" => "Date",
        "article_author" => "Author"
    );
}
include_once("../tpl/news_report.tpl.php");
?>
