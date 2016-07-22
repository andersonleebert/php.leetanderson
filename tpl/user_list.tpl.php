<h1>Users</h1>
<form method="get" action="admin.php">
    <input type="hidden" name="r" value="users" />
    <input type="text" name="search" value="<?php echo (isset($_GET['search']) ? $_GET['search'] : ""); ?>" />
    <input type="submit" name="btnSubmit" value="Search" />
</form>
<table class="adminList">
    <thead>
        <tr>
            <?php
                foreach ($columnsToDisplay as $key => $value)
                {
            ?>
                    <th><?php echo $value; ?></th>
            <?php
                }
            ?>
            <?php
                if ($isAdminUser)
                {
            ?>
                    <th>Edit</th>
                    <th>Delete</th>
            <?php
                }
            ?>
            
        </tr>
    </thead>
    <?php
        while ( $row = $userData->fetch(PDO::FETCH_ASSOC) )
        {
    ?>
            <tr>
                <?php
                    foreach ($columnsToDisplay as $key => $value)
                    {
                ?>
                        <td>
                            <?php
                                if ($key == $permissionColumn) {
                                    echo ($row[$key] == "fb694fee-e4a4-11e5-9e77-7a8325307fec" ? "Administrator" : "Guest" );
                                }
                                else
                                {
                                    echo $row[$key];
                                }
                            ?>
                        </td>
                <?php
                    }
                ?>
                <?php
                    if ($isAdminUser)
                    {
                ?>
                        <td><a href="admin.php?r=user_edit&user_id=<?php echo $row['user_id']; ?>">Edit</a></td>
                        <td><a href="user_list.php?user_id=<?php echo $row['user_id']; ?>&action=delete">Delete</a></td>
                <?php
                    }
                ?>
            </tr>
    <?php
        }
    ?>
</table>
<?php
    if ($isAdminUser)
    {
?>
        <div>
            <h3><a href="admin.php?r=user_edit">Create New User</a></h3>
        </div>
<?php
    }
?>

