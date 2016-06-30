<!DOCTYPE html>
<html>
<head>
    <title>Page list</title>
</head>
<body>
<h1>Pages</h1>
<form method="get" action="page_list.php">
    <input type="text" name="search" />
    <input type="submit" name="btnSubmit" value="Search" />
</form>
<table>
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
            <th>View</th>
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
                <td><a href="page_edit.php?page=<?php echo $row['pages_url_key']; ?>">Edit</a></td>
                <td><a href="page_view.php?page=<?php echo $row['pages_url_key']; ?>">View</a></td>
                <td><a href="page_list.php?page=<?php echo $row['pages_id']; ?>&action=delete">Delete</a></td>
            </tr>
    <?php
        }

    ?>
</table>

<div>
    <h3><a href="page_edit.php">Create New Page</a></h3>
</div>
<div>
    <h3><a href="user_logout.php">Logout</h3>
</div>
</body>
</html>
