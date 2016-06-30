<!DOCTYPE html>
<html>
<head>
    <title>View Article</title>
</head>
<body>
    <h1><?php echo $article['article_title']; ?></h1>
    <p><?php echo $article['article_content']; ?></p>
    <p><?php echo $article['article_author']; ?></p>
    <p><?php echo $article['article_date']; ?></p>
    <p><a href="news_list.php">Back to List</a></p>
</body>
</html>
