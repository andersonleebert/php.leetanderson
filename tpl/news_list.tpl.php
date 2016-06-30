<!DOCTYPE html>
<html>
<head>
    <title>Articles list</title>
</head>
<body>
<h1>News Articles</h1>
<form method="get" action="news_list.php">
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
        while ( $row = $newsResults->fetch(PDO::FETCH_ASSOC) )
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
                <td><a href="news_edit.php?article_id=<?php echo $row['article_id']; ?>">Edit</a></td>
                <td><a href="news_view.php?article_id=<?php echo $row['article_id']; ?>">View</a></td>
                <td><a href="news_list.php?article_id=<?php echo $row['article_id']; ?>&action=delete">Delete</a></td>
            </tr>
    <?php
        }

    ?>
</table>

<div>
    <h3><a href="news_edit.php">Create New Article</a></h3>
</div>
<div>
    <h3><a href="user_logout.php">Logout</h3>
</div>
</body>
</html>
