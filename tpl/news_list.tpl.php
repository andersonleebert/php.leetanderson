<!DOCTYPE html>
<html>
<head>
    <title>Articles list</title>
</head>
<body>
<h1>News Articles</h1>
<form method="get" action="admin.php">
    <input type="hidden" name="r" value="news" />
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
        while ( $row = $newsResults->fetch(PDO::FETCH_ASSOC) )
        {
    ?>
            <tr>
                <?php
                    foreach ($columnsToDisplay as $key => $value)
                    {
                ?>
                        <td>
                            <?php
                                if($key == $dateColumn)
                                {
                                    echo DateTime::createFromFormat("Y-m-d H:i:s",$row[$key])->format("m/d/Y");
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
                <td><a href="admin.php?r=news_edit&article_id=<?php echo $row['article_id']; ?>">Edit</a></td>
                <td><a href="news_list.php?article_id=<?php echo $row['article_id']; ?>&action=delete">Delete</a></td>
            </tr>
    <?php
        }

    ?>
</table>

<div>
    <h3><a href="admin.php?r=news_edit">Create New Article</a></h3>
</div>
</body>
</html>
