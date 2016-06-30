<!DOCTYPE html>
<html>
<head>
    <title>User list</title>
</head>
<body>
<h1>Users</h1>
<form method="get" action="user_list.php">
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
        while ( $row = $userData->fetch(PDO::FETCH_ASSOC) )
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
                <td><a href="user_edit.php?user_id=<?php echo $row['user_id']; ?>">Edit</a></td>
                <td><a href="user_view.php?user_id=<?php echo $row['user_id']; ?>">View</a></td>
                <td><a href="user_list.php?user_id=<?php echo $row['user_id']; ?>&action=delete">Delete</a></td>
            </tr>
    <?php
        }

    ?>
</table>

<div>
    <h3><a href="user_edit.php">Create New User</h3>
    <?php if($isAdminUser){ ?><h3><a href="user_report.php">User report</h3><?php } ?>
</div>
<div>
    <h3><a href="user_logout.php">Logout</h3>
</div>
</body>
</html>
