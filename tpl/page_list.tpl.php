<!DOCTYPE html>
<html>
<head>
    <title>Page list</title>
</head>
<body>
<h1>Pages</h1>
<form method="get" action="admin.php">
    <input type="hidden" name="r" value="pages" />
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
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <?php
        while ( $row = $pageResults->fetch(PDO::FETCH_ASSOC) )
        {
    ?>
            <tr>
                <?php
                    foreach ($columnsToDisplay as $key => $value)
                    {
                ?>
                        <td><?php echo $row[$key]; ?></td>
                <?php
                    }
                ?>
                <td><a href="admin.php?r=page_edit&page=<?php echo $row['pages_url_key']; ?>">Edit</a></td>
                <td><a href="page_list.php?page=<?php echo $row['pages_id']; ?>&action=delete">Delete</a></td>
            </tr>
    <?php
        }

    ?>
</table>

<div>
    <h3><a href="admin.php?r=page_edit">Create New Page</a></h3>
</div>
</body>
</html>
