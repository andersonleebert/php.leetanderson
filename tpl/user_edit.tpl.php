<form action="admin.php?r=user_edit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo (isset($dataValues['user_id']) ? $dataValues['user_id'] : ""); ?>"/><br>
    Username: <input type="text" name="user_username" value="<?php echo (isset($dataValues['user_username']) ? $dataValues['user_username'] : ""); ?>"/><br>
    Password: <input type="text" name="user_password" /><br>
    Permissions: 
    <select name="user_permission_id">
        <option value="">Select</option>
        <?php
            while ($row = $permissions->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <option
                    value="<?php echo $row['user_permission_id']; ?>"
                    <?php echo (isset($dataValues['user_permission_id']) && $dataValues['user_permission_id'] == $row['user_permission_id'] ? 'checked="checked"' : ''); ?>
                    >
                    <?php echo $row['user_permission_name']; ?>
                </option>
        <?php
            }
        ?>
    </select><br />
    <input type="file" name="user_image" value="<?php echo (isset($dataValues['user_image']) ? $dataValues['user_image'] : ""); ?>" />Max file size: 50000<br />
    <input type="submit" name="btnSubmit" value="Submit"/>
</form> 
<div>
    <?php
        foreach ($user->errors as $key => $value)
        {
            echo $value . "<br />";
        };
    ?>
</div>