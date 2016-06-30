<html>
    <body>
        <form action="user_report.php" method="get">
            <div>
                <div>filters:</div>
                Username: <input type="text" name="username_filter" value="<?php echo $_GET['username_filter']; ?>" /><br>
                Permission:
                <select name="user_permission_id_filter">
                    <option value="" >All</option>
                    <?php while($row = $permissions->fetch(PDO::FETCH_ASSOC))
                    {?>
                    <option value="<?php echo $row['user_permission_id']; ?>" <?php if( $row['user_permission_id'] == $_GET['user_permission_id_filter'] ){echo 'selected="selected"';} ?> ><?php echo $row['user_permission_name']; ?></option>
                    <?php
                    }?>
                </select><br>
                <input type="submit" name="btnSubmit" value="Submit"/>
            </div>
        </form> 
        <?php if (isset($userResults)) 
        { ?>
            <table>
                <tr>
                    <td>User ID</td>
                    <td>Username</td>
                    <td>Password</td>
                    <td>Permission ID</td>
                </tr>
            <?php while($row = $userResults->fetch(PDO::FETCH_ASSOC)) 
            { ?>
                <tr>
                    <?php foreach ($row as $column => $data)
                    {?>
                        <td><?php echo $data; ?></td>                    
                    <?php } ?>
                </tr>
            <?php } ?>                                       
            </table>
        <div>
            <?php if (isset($_GET['page']) && $_GET['page'] > 1)
            { ?>
                <a href="user_report.php?username_filter=<?php echo $_GET['username_filter']; ?>&user_permission_id_filter=<?php echo $_GET['user_permission_id_filter']; ?>&btnSubmit=Submit&page=<?php echo ($_GET['page']-1); ?>">Previous</a>
            <?php } ?>
            <a href="user_report.php?username_filter=<?php echo $_GET['username_filter']; ?>&user_permission_id_filter=<?php echo $_GET['user_permission_id_filter']; ?>&btnSubmit=Submit&page=<?php echo (isset($_GET['page']) ? $_GET['page']+1 : 1); ?>">Next</a>
            <a href="user_report.php?download=yes&username_filter=<?php echo $_GET['username_filter']; ?>&user_permission_id_filter=<?php echo $_GET['user_permission_id_filter']; ?>&btnSubmit=Submit">Download</a>
        </div>
        <?php } ?>

    </body>
</html>
