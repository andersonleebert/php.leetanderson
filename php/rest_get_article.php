<?php

require_once('../inc/newsArticle.class.php');
$news = new newsArticle();
$article = "";
if (isset($_GET['article_id']) && !empty($_GET['article_id']))
{
    $news->load(filter_var($_GET['article_id'], FILTER_SANITIZE_STRING));
    $article = $news->data;
}
echo json_encode($article);

?>
