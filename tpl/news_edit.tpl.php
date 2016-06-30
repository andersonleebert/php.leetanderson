<html>
    <body>
        <form action="news_edit.php" method="post">
            <input type="hidden" name="article_id" value="<?php echo (isset($dataValues['article_id']) ? $dataValues['article_id'] : ""); ?>"/><br>
            title: <input type="text" name="article_title" value="<?php echo (isset($dataValues['article_title']) ? $dataValues['article_title'] : ""); ?>"/><br>
            date: <input type="text" name="article_date" value="<?php echo (isset($dataValues['article_date']) ? $dataValues['article_date'] : ""); ?>"/><br>
            author: <input type="text" name="article_author" value="<?php echo (isset($dataValues['article_author']) ? $dataValues['article_author'] : ""); ?>"/><br>
            content: <textarea name="article_content"><?php echo (isset($dataValues['article_content']) ? $dataValues['article_content'] : ""); ?></textarea>
            <input type="submit" name="btnSubmit" value="Submit"/>
        </form> 
        <div>Errors: <?php var_dump($newsArticle->errors); ?></div>

    </body>
</html>
