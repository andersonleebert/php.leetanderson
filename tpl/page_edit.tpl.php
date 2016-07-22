<form action="admin.php?r=page_edit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pages_id" value="<?php echo (isset($dataValues['pages_id']) ? $dataValues['pages_id'] : ""); ?>"/><br>
    Title: <input type="text" name="pages_title" value="<?php echo (isset($dataValues['pages_title']) ? $dataValues['pages_title'] : ""); ?>"/><br>
    Meta: <input type="text" name="pages_meta" value="<?php echo (isset($dataValues['pages_meta']) ? $dataValues['pages_meta'] : ""); ?>"/><br>
    Header: <input type="text" name="pages_h1" value="<?php echo (isset($dataValues['pages_h1']) ? $dataValues['pages_h1'] : ""); ?>"/><br>
    Sub Header: <input type="text" name="pages_subheader" value="<?php echo (isset($dataValues['pages_subheader']) ? $dataValues['pages_subheader'] : ""); ?>"/><br>
    Banner Image: <input type="file" name="pages_image" value="<?php echo (isset($dataValues['pages_image']) ? $dataValues['pages_image'] : ""); ?>"/>Max file size: 50000<br>
    URL Name: <input type="text" name="pages_url_key" value="<?php echo (isset($dataValues['pages_url_key']) ? $dataValues['pages_url_key'] : ""); ?>"/><br>
    Menu Order: <input type="text" name="pages_menu_order" value="<?php echo (isset($dataValues['pages_menu_order']) ? $dataValues['pages_menu_order'] : ""); ?>"/><br>
    Content: <textarea name="pages_content"><?php echo (isset($dataValues['pages_content']) ? $dataValues['pages_content'] : ""); ?></textarea>
    <input type="submit" name="btnSubmit" value="Submit"/>
</form> 
<div>
    <?php
        foreach ($pages->errors as $key => $value)
        {
            echo $value . "<br />";
        };
    ?>
</div>