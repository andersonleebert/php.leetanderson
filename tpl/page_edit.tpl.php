<!DOCTYPE html>
<html>
<head>
    <title>Edit Page</title>
</head>
<body>
    <form action="page_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="pages_id" value="<?php echo (isset($dataValues['pages_id']) ? $dataValues['pages_id'] : ""); ?>"/><br>
        Title: <input type="text" name="pages_title" value="<?php echo (isset($dataValues['pages_title']) ? $dataValues['pages_title'] : ""); ?>"/><br>
        Meta: <input type="text" name="pages_meta" value="<?php echo (isset($dataValues['pages_meta']) ? $dataValues['pages_meta'] : ""); ?>"/><br>
        Header: <input type="text" name="pages_h1" value="<?php echo (isset($dataValues['pages_h1']) ? $dataValues['pages_h1'] : ""); ?>"/><br>
        Banner Image: <input type="file" name="pages_image" value="<?php echo (isset($dataValues['pages_image']) ? $dataValues['pages_image'] : ""); ?>"/>Max file size: 50000<br>
        URL Name: <input type="text" name="pages_url_key" value="<?php echo (isset($dataValues['pages_url_key']) ? $dataValues['pages_url_key'] : ""); ?>"/><br>
        Content: <textarea name="pages_content"><?php echo (isset($dataValues['pages_content']) ? $dataValues['pages_content'] : ""); ?></textarea>
        <input type="submit" name="btnSubmit" value="Submit"/>
    </form> 
    <div>Errors: <?php var_dump($pages->errors); ?></div>
</body>
</html>
