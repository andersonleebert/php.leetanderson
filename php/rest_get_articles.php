<?php

require_once('../inc/newsArticle.class.php');
$news = new newsArticle();
$newsSTMT = $news->getList();
$newsArticleList = $newsSTMT->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($newsArticleList);

?>
