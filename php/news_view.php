<?php
/*require_once('../inc/newsArticle.class.php');
$news = new newsArticle();*/

if (isset($_GET['article_id']) && !empty($_GET['article_id']))
{
    $id = filter_var($_GET['article_id'], FILTER_SANITIZE_STRING);
}
else
{
    header("location:index.php");
    exit;
}

$dataValuesJSON = file_get_contents('http://localhost:8888/WebDev441/week12/public_html/rest_get_article.php?article_id=' . $id);
$article = json_decode($dataValuesJSON, true);
include_once('../tpl/news_view.tpl.php');

?>
